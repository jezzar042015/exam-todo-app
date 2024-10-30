<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        Task::insert(
            [
                [
                    "title" => "Implement POST",
                    "description" => "Create a controller method to handle POST method request",
                    "status" => "not-started"
                ],
                [
                    "title" => "Update User Authentication",
                    "description" => "Enhance user authentication mechanism",
                    "status" => "not-started"
                ],
                [
                    "title" => "Refactor Database Schema",
                    "description" => "Optimize database structure for performance",
                    "status" => "not-started"
                ],
                [
                    "title" => "Design Frontend UI",
                    "description" => "Sketch wireframes and design UI components",
                    "status" => "not-started"
                ],
                [
                    "title" => "Integrate External API",
                    "description" => "Incorporate third-party API for data retrieval",
                    "status" => "not-started"
                ],
                [
                    "title" => "Bug Fixing",
                    "description" => "Address critical bugs reported by QA",
                    "status" => "not-started"
                ],
                [
                    "title" => "Write Unit Tests",
                    "description" => "Implement comprehensive unit tests for modules",
                    "status" => "not-started"
                ],
                [
                    "title" => "Deploy to Production",
                    "description" => "Prepare and deploy application to live servers",
                    "status" => "not-started"
                ],
                [
                    "title" => "Optimize Backend Code",
                    "description" => "Improve backend performance and efficiency",
                    "status" => "not-started"
                ],
                [
                    "title" => "Documentation",
                    "description" => "Create user and developer documentation",
                    "status" => "not-started"
                ],
                [
                    "title" => "Implement Cache Mechanism",
                    "description" => "Introduce caching to reduce response times",
                    "status" => "not-started"
                ],
                [
                    "title" => "Code Review",
                    "description" => "Conduct peer code reviews for quality assurance",
                    "status" => "not-started"
                ],
                [
                    "title" => "Feature Testing",
                    "description" => "Perform end-to-end testing of new features",
                    "status" => "not-started"
                ],
                [
                    "title" => "Enhance Security Measures",
                    "description" => "Implement additional security protocols",
                    "status" => "not-started"
                ],
                [
                    "title" => "Localization Support",
                    "description" => "Add multi-language support to the application",
                    "status" => "not-started"
                ],
                [
                    "title" => "Database Backup Setup",
                    "description" => "Configure automated database backup procedures",
                    "status" => "not-started"
                ],
                [
                    "title" => "Performance Monitoring",
                    "description" => "Set up tools for monitoring application performance",
                    "status" => "not-started"
                ],
                [
                    "title" => "Implement Error Handling",
                    "description" => "Enhance error handling for better user experience",
                    "status" => "not-started"
                ],
                [
                    "title" => "UI/UX Review",
                    "description" => "Conduct UI/UX review and improvements",
                    "status" => "not-started"
                ],
                [
                    "title" => "Database Migration",
                    "description" => "Migrate database to a new version or server",
                    "status" => "not-started"
                ],
                [
                    "title" => "Create Release Notes",
                    "description" => "Prepare release notes for new versions",
                    "status" => "not-started"
                ],
                [
                    "title" => "Implement Email Notifications",
                    "description" => "Set up email notifications for system events",
                    "status" => "not-started"
                ],
                [
                    "title" => "Performance Optimization",
                    "description" => "Fine-tune application performance for scalability",
                    "status" => "not-started"
                ],
                [
                    "title" => "User Acceptance Testing",
                    "description" => "Conduct user acceptance testing with stakeholders",
                    "status" => "not-started"
                ],
                [
                    "title" => "API Documentation",
                    "description" => "Generate API documentation for developers",
                    "status" => "not-started"
                ]
            ]

        );
    }
}
