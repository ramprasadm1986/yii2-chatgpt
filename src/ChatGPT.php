<?php

namespace ramprasadm1986\chatgpt;

use yii\base\Component;
use yii\httpclient\Client;

class ChatGPT extends Component
{
    public $apiKey;
    public $apiUrl = 'https://api.openai.com/v1/chat/completions';
    public $defaultModel = 'gpt-3.5-turbo';  // Default model
    public $defaultRole = "ChatGPT Advisor"

    public function init()
    {
        parent::init();
        if (!$this->apiKey) {
            throw new \Exception('API Key for OpenAI is not set.');
        }
    }

    /**
     * Sends a query to GPT with a custom role and model, useful for various advisors.
     *
     * @param string $query The user’s query.
     * @param string $role Description of the role (e.g., "agricultural advisor").
     * @param string $model Optional specific model to use.
     * @param array $context Context messages for conversational continuity.
     * @return string The GPT response.
     * @throws \Exception if the API request fails.
     */
    public function askGPT($query, $role=null, $model = null, $context = [])
    {
        
        $model = $model ?? $this->defaultModel;
        $role  = $role ?? $this->defaultRole;

        // Set a custom role prompt based on the specific advisor or role
        $rolePrompt = [
            'role' => 'system',
            'content' => "You are a {$role}. Provide expert advice based on your specialized knowledge."
        ];

        $messages = array_merge([$rolePrompt], $context, [['role' => 'user', 'content' => $query]]);

        // Make the API request
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl($this->apiUrl)
            ->addHeaders([ "application/json" => "Content-Type: application/json","Authorization" => "Bearer " . $this->apiKey])
            ->setData([
                'model' => $model,
                'messages' => $messages,
            ])
            ->send();

        if (!$response->isOk) {
            throw new \Exception('Error: ' . $response->statusCode . ' - ' . $response->content);
        }

        $data = $response->data;
        return $data['choices'][0]['message']['content'] ?? '';
    }
}
