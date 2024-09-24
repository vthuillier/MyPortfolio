import { Component } from '@angular/core';
import {NgForOf, NgStyle} from "@angular/common";

@Component({
  selector: 'app-skills',
  standalone: true,
  imports: [
    NgStyle,
    NgForOf
  ],
  templateUrl: './skills.component.html',
  styleUrls: ['./skills.component.scss']
})
export class SkillsComponent {
  skills = [
    { name: 'Java', level: 90, image: 'java' },
    { name: 'Python', level: 85, image: 'python' },
    { name: 'SQL', level: 80, image: 'sql' },
    { name: 'JavaEE', level: 75, image: 'javaee' },
    { name: 'PHP', level: 70, image: 'php' },
    { name: 'Premiers secours', level: 95, image: 'secours' },
    { name: 'Travail d\'équipe', level: 85, image: 'travail_equipe' },
    { name: 'HTML CSS JS', level: 80, image: 'html_css_js' },
    { name: 'C', level: 65, image: 'c' },
    { name: 'Git', level: 90, image: 'git' },
    { name: 'Angular', level: 75, image: 'angular' },
    { name: 'TypeScript', level: 85, image: 'typescript' },
    { name: 'API REST', level: 80, image: 'api_rest' }
  ];

  constructor() {
    this.skills.sort((a, b) => b.level - a.level);
  }

  getImagePath(imageName: string): string {
    return `assets/skills/${imageName}.png`;
  }
}
