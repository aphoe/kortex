# Kortex - AI Knowledge Management System

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

This is the source code for [The Kortex App](https://kortex.aphoe.com) – Your intelligent knowledge engine for the AI revolution.

## About Kortex
### Collect. Connect. Create.

Kortex is a centralized hub where researchers, developers, and enthusiasts systematically organize AI discoveries. The platform empowers you to collect tools, models, courses, and resources through intuitive bookmarking and annotation. By automatically connecting related entities across your library, Kortex reveals hidden patterns between research papers, frameworks, and practical applications. This structured intelligence helps you create personalized learning paths, project templates, and shareable knowledge repositories.

## Features

- **Resource Management**
  - Organize AI tools, courses, tutorials, and research papers
  - Categorize and tag resources for easy discovery
  - Add detailed notes and annotations

- **Certification Tracking**
  - Track professional certifications
  - Monitor certification providers and requirements
  - Set and track learning goals

- **Knowledge Graph**
  - Automatic relationship mapping between resources
  - Visualize connections between concepts
  - Discover related content

- **Collaboration**
  - Share resources and collections
  - Comment and discuss with team members
  - Version control for knowledge assets

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Web server (Apache/Nginx)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/aphoe/kortex.git
   cd kortex
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   npm run build
   ```

4. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   
   Update the `.env` file with your database credentials and other settings.

5. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

7. **Access the application**
   Open your browser and navigate to `http://localhost:8000`

## Documentation

For detailed documentation, please visit our [Documentation Wiki](https://github.com/aphoe/kortex/wiki).

## Contributing

We welcome contributions! Please read our [Contributing Guide](CONTRIBUTING.md) for details on our code of conduct and the process for submitting pull requests.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE.md) file for details.

## Acknowledgments

- Built with [Laravel](https://laravel.com) and [Filament](https://filamentphp.com)
- Icons by [Heroicons](https://heroicons.com/)
- Inspired by the need for better knowledge management in AI research
