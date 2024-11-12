<?php

namespace ramprasadm1986\chatgpt;

class AgriAdvisorGPT extends ChatGPT
{
    /**
     * Sends an agricultural advisory question to the GPT model.
     *
     * @param string $question The agricultural question (e.g., about crops, soil, pest management).
     * @param array $context Additional messages for conversation continuity.
     * @return string The response from Agri Advisor GPT.
     * @throws \Exception if the API request fails.
     */
    public function askAgriAdvisor($question, $context = [],$model=null)
    {
        // Set a tailored prompt to guide the AI in responding as an agricultural advisor
        $agriPrompt = [
            'role' => 'system',
            'content' => 'You are an agricultural advisor with expertise in crop management, pest control, soil health, and sustainable farming. Provide expert, actionable advice.'
        ];

        // Combine the agricultural-specific prompt with the question and any previous context
        $messages = array_merge([$agriPrompt], $context, [['role' => 'user', 'content' => $question]]);

        // Call the base ChatGPT functionality to send the request
        return $this->askGPT($question, 'agricultural advisor', $model, $context);
    }

    /**
     * Provide a crop-specific advisory prompt.
     *
     * @param string $crop The name of the crop to focus on.
     * @param string $question The user question.
     * @param array $context Additional conversation messages.
     * @return string The tailored crop-specific advice.
     * @throws \Exception if the API request fails.
     */
    public function askCropAdvisor($crop, $question, $context = [],$model=null)
    {
        $cropPrompt = [
            'role' => 'system',
            'content' => "You are an expert in agriculture, providing specialized advice on $crop cultivation, pest control, soil management, and crop yield improvement."
        ];

        $messages = array_merge([$cropPrompt], $context, [['role' => 'user', 'content' => $question]]);
        
        return $this->askGPT($question, "agricultural advisor on $crop", $model, $context);
    }
}
