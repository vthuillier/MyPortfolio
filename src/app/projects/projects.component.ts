import { Component } from '@angular/core';
import {NgForOf, NgIf} from "@angular/common";

@Component({
  selector: 'app-projects',
  standalone: true,
  imports: [
    NgForOf,
    NgIf
  ],
  templateUrl: './projects.component.html',
  styleUrls: ['./projects.component.scss']
})
export class ProjectsComponent {
  selectedProject: any = null;

  projects = [
    {
      title: 'Développement d\'une API REST 🍕',
      description: 'Projet réalisé en 2ème année à l\'IUT de Lille. Le but était de développer une API REST pour une pizzeria 🏪. L\'API permet de gérer les ingrédients, les pizzas, et les commandes, facilitant ainsi les opérations de la pizzeria.',
      technologies: ['API REST', 'JavaEE', 'PostgreSQL', 'SQL', 'Rédaction de rapport'],
      image: 'assets/projects/api-rest.png',
      link: 'https://github.com/vthuillier/S4.A02.1-Api_REST'
    },
    {
      title: 'UniCo | Affectation d\'étudiants 👨‍🎓👩‍🎓',
      description: 'Projet en équipe de 3, réalisé pour affecter des étudiants à des séjours linguistiques 🗣️ en fonction de critères comme les allergies et passe-temps. Nous avons utilisé des algorithmes de graphes pour les associations optimales.',
      technologies: ['Java', 'Graphes', 'JavaFX', 'CSV'],
      image: 'assets/projects/unico.png',
      link: 'https://github.com/vthuillier/UniCo'
    },
    {
      title: 'Chasse au Monstre 👾',
      description: 'Projet de jeu réalisé à l\'IUT de Lille. Le but était de concevoir et développer un jeu vidéo 🎮 avec une interface graphique en Java. Nous avons travaillé en groupe pour créer le diagramme de cas d\'utilisation et de classes avant d\'implémenter les fonctionnalités du jeu.',
      technologies: ['Java', 'IHM', 'Algorithmes IA', 'JavaFX', 'Algorithme A*'],
      image: 'assets/projects/chasse-au-monstre.png',
      link: 'https://github.com/vthuillier/ChasseAuMonstre'
    },
    {
      title: 'Space Invaders ++ 🚀',
      description: 'Projet en équipe de 2 : développement d\'un jeu Shoot\'Em Up inspiré de Space Invaders en TypeScript 👾. Nous avons intégré un système de score, de vies, de niveaux, et de difficulté, ainsi qu\'un mode multijoueur via Socket.io.',
      technologies: ['TypeScript', 'HTML/CSS', 'Socket.io', 'Git', 'Node.js'],
      image: 'assets/projects/space-invaders.png',
      link: 'https://github.com/vthuillier/SpaceInvadersPlusPlus'
    },
    {
      title: 'E-Portfolio en Angular 🌐',
      description: 'Création de mon portfolio personnel 💼 en Angular, avec des animations et un mode dark/light pour une expérience utilisateur personnalisée.',
      technologies: ['Angular', 'TypeScript', 'SCSS', 'Bootstrap'],
      image: 'assets/projects/portfolio-angular.png',
      link: 'https://github.com/vthuillier/MyPortfolio'
    }
  ];

  openProject(project: any) {
    this.selectedProject = project;
  }

  closeModal() {
    this.selectedProject = null;
  }
}
