import { Component } from '@angular/core';
import {NgForOf} from "@angular/common";

@Component({
  selector: 'app-experiences',
  standalone: true,
  imports: [
    NgForOf
  ],
  templateUrl: './experiences.component.html',
  styleUrl: './experiences.component.scss'
})
export class ExperiencesComponent {

    experiences = [
      {
        name: "Stagiaire en machine learning",
        company: "Vallourec",
        locate: "Aulnoye-Aymeries",
        start: "04/01/2024",
        end: "07/01/2024",
        description: "Stage de 2ème année de BUT Informatique chez Vallourec à Aulnoye-Aymeries. J'ai travaillé sur un projet de machine learning" +
            "pour les épaisseurs de la solution CLEANWELL®. J'ai utilisé les librairies de machine learning de Python (Pandas, Numpy, PyIPSDK) mais" +
            "aussi des librairies de visualisation d'image (OpenCV, PIL).",
        img: "assets/experiences/vallourec.png"
      },
      {
        name: "Sapeur-pompier volontaire",
        company: "SDIS 62",
        locate: "Oignies",
        start: "10/01/2024",
        end: "10/01/2099",
        description: "Sapeur-pompier volontaire au SDIS 62 à Oignies. J'ai suivi une formation initiale de plusieurs semaines pour apprendre les bases" +
            "du métier de pompier. J'ai ensuite suivi des formations complémentaires pour être apte Sécurité Routière",
        img: "assets/education/spv.jpg"
      },
      {
        name: "Alternant développeur",
        company: "Extern-SN",
        locate: "Wambrechies",
        start: "09/02/2024",
        end: "08/28/2025",
        description: "Alternance de 3ème année de BUT Informatique chez Extern-SN à Wambrechies. Je travaille pour diverses entreprises" +
            "mais aussi pour des projets internes comme La Sentinnelle. J'utilise principalement les technologies web (Angular, NodeJS, MongoDB) mais" +
            "aussi des technologies back-end (Python, Kubernetes).",
        img: "assets/experiences/extern-sn.png"
      }
    ]

  isOngoing(endDate: string): string {
    const currentDate = new Date();
    return (!endDate || new Date(endDate) > currentDate) ? 'En cours' : this.formatDate(endDate);
  }

  formatDate(date: string): string {
    const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'long' };
    return new Date(date).toLocaleDateString('fr-FR', options);
  }

}
