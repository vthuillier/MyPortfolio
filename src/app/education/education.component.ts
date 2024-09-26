import { Component } from '@angular/core';
import {DatePipe, NgForOf} from "@angular/common";

@Component({
  selector: 'app-education',
  standalone: true,
  imports: [
    DatePipe,
    NgForOf
  ],
  templateUrl: './education.component.html',
  styleUrl: './education.component.scss'
})
export class EducationComponent {

  education = [
    {
      name: "Baccalauréat générale",
      specialities: "Numérique et Sciences Informatiques / Mathématique",
      start: "09/02/2019",
      end: "07/01/2022",
      location: "Lycée Beaupré, Haubourdin",
      description: "Baccalauréat général en Numérique et Sciences Informatiques et Mathématique au lycée Beaupré à Haubourdin." +
          "J'ai choisi cette filière car je suis passionné par l'informatique et les mathématiques. J'avais aussi pris l'option" +
            "SI (Science de l'Ingénieur) en classe de seconde et en première.",
      img: "assets/education/bac.jpg"
    },
    {
      name: "BUT Informatique",
      specialities: "réalisation d'applications - conception - développement - validation",
      start: "09/02/2022",
      end: "07/01/2025",
      location: "IUT A, Lille",
      description: "Bachelor universitaire de technologie en informatique à l'IUT A de Lille. J'ai choisi cette formation car" +
          "je suis passionné par l'informatique et que je souhaite devenir développeur mais aussi" +
          "elle est très axée sur la pratique et la réalisation de projets.",
      img: "assets/education/but.png"
    },
    {
      name: "Sapeur-Pompier Volontaire",
      specialities: "Formation initiale de sapeur-pompier volontaire",
      start: "10/01/2023",
      end: "10/01/2025",
      location: "Centre de secours de Oignies",
      description: "Formation initiale de sapeur-pompier volontaire au centre de secours de Oignies",
      img: "assets/education/spv.jpg"
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
