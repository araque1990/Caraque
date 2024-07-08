<?php

declare(strict_types=1);

namespace Caraque\Sentimate\Model;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;

class ReviewConsumer
{
    /**
     * Constructor for queue consumer.
     *
     * @param GuzzleClient $guzzleClient
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly GuzzleClient    $guzzleClient,
        private readonly LoggerInterface $logger,
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
            $response = $this->guzzleClient->request(
                'POST',
                'https://twinword-sentiment-analysis.p.rapidapi.com/analyze/',
                [
                    'multipart' => [
                        [
                            'name' => 'text',
                            'contents' => 'great value in its price range!'
                        ]
                    ],
                    'headers' => [
                        'x-rapidapi-host' => 'twinword-sentiment-analysis.p.rapidapi.com',
                        'x-rapidapi-key' => '0aa7a3a82bmshd39a6f1836488ebp1a429cjsn6d4e15dcc312',
                    ],
                ],
            );

            $this->logger->info('Sentiment Analysis', [
                'Message' => $message,
                'Response Body' => $response->getBody(),
            ]);
        } catch (GuzzleException $exception) {
            $this->logger->error(__('Sentiment Analysis API returned an error: %1', $exception->getMessage()));
        }
    }
}
