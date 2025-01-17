<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f9fafb;
            padding: 2rem;
            color: #333;
        }

        /* Card Container and Cards */
        .card-container {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
            margin: 2rem auto;
            max-width: 1200px;
            box-sizing: border-box;
        }

        .info-card {
            display: flex;
            flex-direction: column;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .card-content {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .card-title {
            font-size: 0.9rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #4b5563;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .card-heading {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1f2937;
            line-height: 1.5;
            margin-bottom: 0.75rem;
        }

        .card-description {
            font-size: 1rem;
            line-height: 1.6;
            color: #6b7280;
            max-height: 70px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .card-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .loading {
            text-align: center;
            padding: 2rem;
            color: #6b7280;
            font-size: 1.125rem;
        }

        .error {
            text-align: center;
            padding: 2rem;
            color: #dc2626;
            font-size: 1.125rem;
            background-color: #fee2e2;
            border-radius: 8px;
            margin: 2rem auto;
            max-width: 600px;
        }

        /* Responsive Design */
        @media (min-width: 768px) {
            .card-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .card-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Utility Classes */
        .text-gray-500 { color: #6b7280; }
        .text-gray-800 { color: #1f2937; }
        .text-blue-500 { color: #3b82f6; }
        .text-green-500 { color: #10b981; }
        .text-gray-400 { color: #9ca3af; }
    </style>
</head>
<body>

    <!-- Articles Section -->
    <div id="loading" class="loading">Loading articles...</div>
    <div id="error" class="error" style="display: none;"></div>
    <div id="articles-container" class="card-container"></div>

    <script>
        // Function to fetch and display articles
        async function fetchArticles() {
            const loadingElement = document.getElementById('loading');
            const errorElement = document.getElementById('error');
            
            try {
                loadingElement.style.display = 'block';
                errorElement.style.display = 'none';

                const response = await fetch('/get-artikel');
                const responseText = await response.text(); 
                
                console.log('Raw response:', responseText); // Debug log
                
                try {
                    const result = JSON.parse(responseText);
                    if (result.status === 'success') {
                        // Display only the first 4 articles
                        displayArticles(result.data.slice(0, 3));
                    } else {
                        throw new Error(result.message || 'Failed to fetch articles');
                    }
                } catch (parseError) {
                    console.error('JSON Parse Error:', parseError);
                    throw new Error('Invalid response format');
                }
            } catch (error) {
                console.error('Detailed error:', error);
                errorElement.textContent = `Error: ${error.message}`;
                errorElement.style.display = 'block';
            } finally {
                loadingElement.style.display = 'none';
            }
        }

        // Function to display articles in the UI
        function displayArticles(articles) {
            const container = document.getElementById('articles-container');
            if (!container) {
                console.error('Container element not found');
                return;
            }

            container.innerHTML = ''; // Clear existing content

            articles.forEach(article => {
                const articleElement = document.createElement('div');
                articleElement.className = 'info-card';
                
                articleElement.innerHTML = `
                <a href="/artikel/${article.id}" style="text-decoration: none; color: inherit;">
                    <img src="${escapeHtml(article.image)}" alt="Article Image" class="card-image">
                    <div class="card-content">
                        <h3 class="card-title text-gray-500">${escapeHtml(article.title)}</h3>
                        <p class="card-heading text-gray-800">${escapeHtml(article.subtitle || '')}</p>
                        <p class="card-description text-gray-800">${escapeHtml(truncateText(article.content, 150))}</p>
                    </div>
                </a>
                `;
                
                container.appendChild(articleElement);
            });
        }

        // Helper function to escape HTML and prevent XSS
        function escapeHtml(unsafe) {
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        // Call the fetch function when the page loads
        document.addEventListener('DOMContentLoaded', fetchArticles);

        // Function to truncate text to a specific character limit
        function truncateText(text, limit) {
            if (text.length > limit) {
                return text.substring(0, limit) + '...';
            }
            return text;
        }
    </script>
</body>
</html>
