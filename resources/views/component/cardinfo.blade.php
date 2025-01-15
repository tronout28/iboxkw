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
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f3f4f6;
            padding: 2rem;
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
            align-items: flex-start;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 2rem;
            transition: transform 0.2s ease;
            width: 100%;   
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .card-content {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            width: 100%;
        }

        .card-title {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            color: #6b7280;
        }

        .card-heading {
            font-size: 1.25rem;
            font-weight: 600;
            line-height: 1.4;
            color: #1f2937;
        }

        .card-description {
            font-size: 1rem;
            line-height: 1.5;
            color: #4b5563;
        }

        /* Loading State */
        .loading {
            text-align: center;
            padding: 2rem;
            color: #6b7280;
            font-size: 1.125rem;
        }

        /* Error State */
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

        /* Feature Cards */
        .feature-cards {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
            margin: 2rem auto;
            max-width: 1200px;
        }

        /* Responsive Design */
        @media (min-width: 768px) {
            .card-container,
            .feature-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .card-container,
            .feature-cards {
                grid-template-columns: repeat(4, 1fr);
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
    <!-- Feature Cards Section -->
    <div class="feature-cards">
        <!-- Pickup Card -->
        <div class="info-card">
            <div class="card-content">
                <h3 class="card-title text-gray-500">PICKUP</h3>
                <p class="card-heading text-gray-800">Kirim dan ambil.</p>
                <p class="card-description text-gray-800">Belanja online dan bebas biaya kirim.</p>
            </div>
        </div>

        <!-- Financing Card -->
        <div class="info-card">
            <div class="card-content">
                <h3 class="card-title text-blue-500">FINANCING</h3>
                <p class="card-heading text-gray-800">Dapatkan harga spesial dan cicilan 0%</p>
                <p class="card-description text-blue-500">untuk produk-produk Apple.</p>
            </div>
        </div>

        <!-- Experience Days Card -->
        <div class="info-card">
            <div class="card-content">
                <h3 class="card-title text-gray-500">IBOX EXPERIENCE DAYS</h3>
                <p class="card-heading text-gray-800">Maksimalkan penggunaan produk Apple anda</p>
                <p class="card-description text-gray-400">bersama Apple expert</p>
            </div>
        </div>

        <!-- Sale Card -->
        <div class="info-card">
            <div class="card-content">
                <h3 class="card-title text-green-500">SALE</h3>
                <p class="card-heading">
                    <span class="text-green-500">Penawaran terbaik hari ini</span>
                    <span class="text-gray-800">untuk Belanja Online dan Click & PickUp</span>
                </p>
            </div>
        </div>
    </div>

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
        const responseText = await response.text(); // Get raw response text
        
        console.log('Raw response:', responseText); // Debug log
        
        try {
            const result = JSON.parse(responseText);
            if (result.status === 'success') {
                displayArticles(result.data);
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
                    <div class="card-content">
                        <h3 class="card-title text-gray-500">${escapeHtml(article.title)}</h3>
                        <p class="card-heading text-gray-800">${escapeHtml(article.subtitle || '')}</p>
                        <p class="card-description text-gray-800">${escapeHtml(article.content)}</p>
                    </div>
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
    </script>
</body>
</html>