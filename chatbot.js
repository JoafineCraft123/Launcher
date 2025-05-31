import express from 'express';
import fetch from 'node-fetch';

const app = express();
const port = process.env.PORT || 3000;

app.use(express.json());

app.post('/chatbot', async (req, res) => {
  const { prompt } = req.body;
  if (!prompt) return res.status(400).json({ error: 'Missing prompt' });

  const apiKey = process.env.OPENAI_API_KEY;
  if (!apiKey) return res.status(500).json({ error: 'API key not configured' });

  try {
    const response = await fetch('https://api.openai.com/v1/chat/completions', {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${apiKey}`,
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        model: 'gpt-3.5-turbo',
        messages: [{ role: 'user', content: prompt }],
      }),
    });

    const data = await response.json();

    if (data.error) return res.status(500).json({ error: data.error.message });

    const reply = data.choices[0].message.content;
    res.json({ response: reply });
  } catch {
    res.status(500).json({ error: 'OpenAI request failed' });
  }
});

app.listen(port, () => console.log(`Server listening on port ${port}`));
