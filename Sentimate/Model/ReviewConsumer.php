<?php

declare(strict_types=1);

namespace Caraque\Sentimate\Model;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Magento\Framework\Serialize\SerializerInterface;
use Psr\Log\LoggerInterface;
use Caraque\Sentimate\Model\ResourceModel\ReviewSentiment as ReviewSentimentResource;
use Caraque\Sentimate\Model\ReviewSentimentFactory;

class ReviewConsumer
{
    /**
     * Constructor for queue consumer.
     *
     * @param GuzzleClient $guzzleClient
     * @param LoggerInterface $logger
     * @param SerializerInterface $serializer
     * @param ReviewSentimentResource $reviewSentimentResourceModel
     * @param ReviewSentimentFactory $reviewSentimentFactory
     */
    public function __construct(
        private readonly GuzzleClient            $guzzleClient,
        private readonly LoggerInterface         $logger,
        private readonly SerializerInterface     $serializer,
        private readonly ReviewSentimentResource $reviewSentimentResourceModel,
        private readonly ReviewSentimentFactory  $reviewSentimentFactory,
    )
    {
    }

    /**
     * Queue consumer process handler.
     *
     * @param string $message
     * @return void
     */
    public function process(
        string $message
    ): void
    {
        // Code to execute on message
        try {
            $deserializedMessage = $this->serializer->unserialize($message);
            $title = $deserializedMessage['title'];
            $detail = $deserializedMessage['detail'];
            $text = "$title: $detail";

            $response = $this->guzzleClient->request(
                'POST',
                'https://twinword-sentiment-analysis.p.rapidapi.com/analyze/',
                [
                    'multipart' => [
                        [
                            'name' => 'text',
                            'contents' => $text
                        ]
                    ],
                    'headers' => [
                        'x-rapidapi-host' => 'twinword-sentiment-analysis.p.rapidapi.com',
                        'x-rapidapi-key' => '0aa7a3a82bmshd39a6f1836488ebp1a429cjsn6d4e15dcc312',
                    ],
                ],
            );

            $body = $response->getBody();
            $deserializedResponse = $this->serializer->unserialize($body);

            $this->logger->info('Sentiment Analysis', [
                'Message' => $deserializedMessage,
                'Response Body' => $deserializedResponse,
            ]);

            if (isset($deserializedResponse['type'], $deserializedResponse['score'], $deserializedResponse['ratio'])) {
                $reviewSentiment = $this->reviewSentimentFactory->create();
                $reviewSentiment->setData([
                    'review_id' => $deserializedMessage['review_id'],
                    'type' => $deserializedResponse['type'],
                    'score' => $deserializedResponse['score'],
                    'ratio' => $deserializedResponse['ratio'],
                ]);

                try {
                    $this->reviewSentimentResourceModel->save($reviewSentiment);
                } catch (Exception $e) {
                    $this->logger->error(__('Failed to save sentiment analysis: %1', $e->getMessage()));
                }
            } else {
                $stringResponse = implode(', ', $deserializedResponse);
                $this->logger->error(__('Sentiment Analysis API did not return expected results: %1', $stringResponse));
            }
        } catch (GuzzleException $exception) {
            $this->logger->error(__('Sentiment Analysis API returned an error: %1', $exception->getMessage()));
        } catch (Exception $exception) {
            $this->logger->error(__('Failed to deserialize sentiment analysis results: %1', $exception->getMessage()));
        }
    }
}
