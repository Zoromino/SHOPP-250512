<?php
require_once("vendor/autoload.php");
require_once("Classes/Product.php");
require_once("Classes/Database.php");

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$dotenv = Dotenv\Dotenv::createImmutable("."); // .for the PAGE
$dotenv->load();

class SearchEngine
{
    private $accessKey = '';
    private $secretKey = '';
    private $url = '';
    private $index_name = "";

    private $client;

    function __construct()
    {
        $this->accessKey = $_ENV['ACCESS_KEY'];
        $this->secretKey = $_ENV['SECRET_KEY'];
        $this->url = $_ENV['URL'];
        $this->index_name = $_ENV['INDEX_NAME'];

        $this->client = new Client([
            'base_uri' => $this->url,
            'verify' => false,
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->accessKey . ':' . $this->secretKey),
                'Content-Type' => 'application/json'
            ]
        ]);

    }

    function getDocumentIdOrUndefined(string $webId): ?string
    {
        $query = [
            'query' => [
                'term' => [
                    'webid' => $webId
                ]
            ]
        ];


        try {
            $response = $this->client->post("/api/index/v1/{$this->index_name}/_search", [
                'json' => $query
            ]);

            $data = json_decode($response->getBody(), true);

            if (empty($data['hits']['total']['value'])) {
                return null;
            }

            return $data['hits']['hits'][0]['_id'];
        } catch (RequestException $e) {
            // Hantera eventuella fel här
            echo $e->getMessage();
            return null;
        }
    }

    function search(string $query, string $sortCol, string $sortOrder, int $pageNo, int $pageSize)
    {

        $aa = $query . '*';
        $query = [
            'query' => [
                'query_string' => [
                    'query' => $aa,
                ]
            ],
            'from' => ($pageNo - 1) * $pageSize,
            'size' => $pageSize,
            'sort' => [
                $sortCol => [
                    'order' => $sortOrder
                ]
            ],
            'aggs' => [
                'facets' => [
                    'nested' => [
                        'path' => 'string_facet',

                    ],
                    'aggs' => [
                        'names' => [
                            'terms' => [
                                'field' => 'string_facet.facet_name',
                                'size' => 10
                            ],
                            'aggs' => [
                                'values' => [
                                    'terms' => [
                                        'field' => 'string_facet.facet_value',
                                        'size' => 10
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ];

        try {
            $response = $this->client->post("/api/index/v1/{$this->index_name}/_search", [
                'json' => $query
            ]);

            $data = json_decode($response->getBody(), true);

            if (empty($data['hits']['total']['value'])) {
                return null;
            }

            $data["hits"]["hits"] = $this->convertSearchEngineArrayToProduct($data["hits"]["hits"]);
            $pages = ceil($data["hits"]["total"]["value"] / $pageSize);

            return [
                "data" => $data["hits"]["hits"],
                "num_pages" => $pages,
                "aggregations" => $data["aggregations"]["facets"]['names']['buckets']
            ];
        } catch (RequestException $e) {
            // Hantera eventuella fel här
            echo $e->getMessage();
            return null;
        }
    }

    function convertSearchEngineArrayToProduct($searchengineResults)
    {
        $newarray = [];
        foreach ($searchengineResults as $hit) {
            $prod = new Product();
            // $prod->searchengineid = $hit["_id"];
            $prod->id = $hit["_source"]["webid"];
            $prod->title = $hit["_source"]["title"];
            $prod->description = $hit["_source"]["description"];
            $prod->price = $hit["_source"]["price"];
            $prod->categoryName = $hit["_source"]["categoryName"];
            $prod->imageUrl = $hit["_source"]["imageUrl"];
            $prod->popularityFactor = $hit["_source"]["popularityFactor"];
            // $prod->categoryId = $hit["_source"]["categoryId"];
            // $prod->color = $hit["_source"]["color"];
            $prod->stock = $hit["_source"]["stock"];

            array_push($newarray, $prod);
        }
        return $newarray;

    }

}





