<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run()
    {
        $skills = [
            // Programming Languages
            ['name' => 'PHP', 'description' => 'PHP programming language', 'category' => 'Programming', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'JavaScript', 'description' => 'JavaScript programming', 'category' => 'Programming', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Python', 'description' => 'Python programming language', 'category' => 'Programming', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Java', 'description' => 'Java programming language', 'category' => 'Programming', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'C++', 'description' => 'C++ programming language', 'category' => 'Programming', 'level' => 'advanced', 'is_active' => true],
            ['name' => 'Go', 'description' => 'Go programming language', 'category' => 'Programming', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Rust', 'description' => 'Rust programming language', 'category' => 'Programming', 'level' => 'advanced', 'is_active' => true],

            // Frameworks
            ['name' => 'Laravel', 'description' => 'PHP Laravel framework', 'category' => 'Framework', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'React', 'description' => 'React JavaScript library', 'category' => 'Framework', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Vue.js', 'description' => 'Vue.js JavaScript framework', 'category' => 'Framework', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Angular', 'description' => 'Angular framework', 'category' => 'Framework', 'level' => 'advanced', 'is_active' => true],
            ['name' => 'Django', 'description' => 'Python Django framework', 'category' => 'Framework', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Spring Boot', 'description' => 'Java Spring Boot framework', 'category' => 'Framework', 'level' => 'advanced', 'is_active' => true],

            // Databases
            ['name' => 'MySQL', 'description' => 'MySQL database management', 'category' => 'Database', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'PostgreSQL', 'description' => 'PostgreSQL database', 'category' => 'Database', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'MongoDB', 'description' => 'MongoDB NoSQL database', 'category' => 'Database', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Redis', 'description' => 'Redis in-memory database', 'category' => 'Database', 'level' => 'intermediate', 'is_active' => true],

            // DevOps & Tools
            ['name' => 'Docker', 'description' => 'Docker containerization', 'category' => 'DevOps', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Kubernetes', 'description' => 'Kubernetes orchestration', 'category' => 'DevOps', 'level' => 'advanced', 'is_active' => true],
            ['name' => 'AWS', 'description' => 'Amazon Web Services', 'category' => 'Cloud', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Azure', 'description' => 'Microsoft Azure', 'category' => 'Cloud', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Git', 'description' => 'Git version control', 'category' => 'Tools', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Jenkins', 'description' => 'Jenkins CI/CD', 'category' => 'DevOps', 'level' => 'intermediate', 'is_active' => true],

            // Design & UI/UX
            ['name' => 'Adobe Photoshop', 'description' => 'Image editing and design', 'category' => 'Design', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Figma', 'description' => 'UI/UX design tool', 'category' => 'Design', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Adobe Illustrator', 'description' => 'Vector graphics design', 'category' => 'Design', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Sketch', 'description' => 'Digital design toolkit', 'category' => 'Design', 'level' => 'intermediate', 'is_active' => true],

            // Soft Skills
            ['name' => 'Project Management', 'description' => 'Managing projects and teams', 'category' => 'Management', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Team Leadership', 'description' => 'Leading and motivating teams', 'category' => 'Leadership', 'level' => 'intermediate', 'is_active' => true],
            ['name' => 'Communication', 'description' => 'Effective communication skills', 'category' => 'Soft Skills', 'level' => 'advanced', 'is_active' => true],
            ['name' => 'Problem Solving', 'description' => 'Analytical problem solving', 'category' => 'Soft Skills', 'level' => 'advanced', 'is_active' => true],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
