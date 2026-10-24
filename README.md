
# Hello Elementor Category Archive

A custom WordPress category archive implementation designed for websites using the Hello Elementor child theme.

The project includes a PHP archive template, a category template loader, and a dedicated stylesheet for displaying category information and article listings in a responsive layout.

## Features

- Custom category archive header and title
- Category description and breadcrumb navigation
- Category filter navigation
- Responsive article listings with featured images
- Publication dates, excerpts, and read-more links
- Recent posts sidebar
- Popular posts sidebar, ordered by comment count
- WordPress pagination
- Empty-category fallback message
- Responsive layouts for desktop, tablet, and mobile
- Scoped CSS styling and keyboard focus indicators
- Reduced-motion accessibility support

## Technology Stack

- WordPress
- Hello Elementor child theme
- PHP
- HTML5
- CSS3

## Repository Structure

```text
hello-elementor-category-archive/
├── README.md
├── category.php
├── custom-category.php
├── assets/
│   └── css/
│       └── category-archive.css
```

## Requirements

- A working WordPress installation
- The Hello Elementor parent theme
- An active child theme
- Published WordPress posts assigned to categories

## Installation

1. Back up your website and test changes in a staging environment.
2. Activate your Hello Elementor child theme.
3. Place `category.php` in the child theme directory.
4. Place `custom-category.php` in the child theme directory.
5. Place `category-archive.css` in `assets/css/` inside the child theme directory.
6. Integrate the stylesheet enqueue logic from the relevant `functions.php` section into your child theme's existing functions file.
7. Open a category archive page and verify the layout.

Do not replace your existing `functions.php` with a partial or unrelated example. Merge only the required category archive functionality.

## Compatibility

This customization is intended for a Hello Elementor child theme. Compatibility depends on the WordPress, PHP, and theme versions used.

Test the implementation in a staging environment before deploying it to a live website.

## Scope

This repository contains category archive customization source files. It is not a complete WordPress theme or plugin.

## License

Hello Elementor has its own license and copyright terms. Refer to the official parent theme repository for details.

## Disclaimer

This is an independent customization project and is not an official Elementor product or endorsed by Elementor.
