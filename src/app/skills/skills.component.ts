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
  styleUrls: ['./skills.component.scss'] // Corrigez le 'styleUrls'
})
export class SkillsComponent {
  selectedSkill: any = null;  // Pour suivre la compétence sélectionnée

  skills = [
    { name: 'Java', level: 80, image: 'java', description: 'Java est le premier langage de programmation que j\'ai touché. \n Appris pour modder mon Minecraft, je l\'utilise aujourd\'hui à l\'université.' },
    { name: 'Python', level: 90, image: 'python', description: 'Python est surement mon langage de programmation préféré, on peut tout faire avec. Je l\'utilise aujourd\'hui chez Extern-SN' },
    { name: 'SQL', level: 80, image: 'sql', description: 'Pratique en base de données relationnelle tout le temps. ' },
    { name: 'JavaEE', level: 75, image: 'javaee', description: 'Appris dans le cadre de projets universitaires, je ne l\'utilise pas autre part' },
    { name: 'PHP', level: 60, image: 'php', description: 'Utilisé pour la création de sites web dynamiques avant que je connaisse JavaEE.' },
    { name: 'Premiers secours', level: 95, image: 'secours', description: 'Formation en tant que sapeur-pompier volontaire.' },
    { name: 'HTML CSS JS', level: 80, image: 'html_css_js', description: 'Utilisé dans le cadre de développement de sites web front-end.' },
    { name: 'C', level: 65, image: 'c', description: 'Étudié pendant mes cours universitaires de programmation bas niveau.' },
    { name: 'Git', level: 90, image: 'git', description: 'Utilisé dans la gestion de projets collaboratifs sur GitHub et GitLab.' },
    { name: 'Angular', level: 75, image: 'angular', description: 'En cours d’apprentissage dans le cadre de mon e-portfolio.' },
    { name: 'TypeScript', level: 85, image: 'typescript', description: 'Utilisé pour structurer des applications web Vue.js.' },
    { name: 'API REST', level: 80, image: 'api_rest', description: 'Appris avec JavaEE.' }
  ];

  // Ouvrir la modal avec les informations de la compétence sélectionnée
  openSkillDetails(skill: any) {
    this.selectedSkill = skill;
  }

  getImagePath(imageName: string): string {
    return `assets/skills/${imageName}.png`;
  }
}
