import { Component } from '@angular/core';
import {NgForOf} from "@angular/common";

@Component({
  selector: 'app-about',
  standalone: true,
  imports: [
    NgForOf
  ],
  templateUrl: './about.component.html',
  styleUrl: './about.component.scss'
})
export class AboutComponent {

  name: string = "Valentin THUILLIER";
  jobs = [
    "alternant développeur",
    "sapeur-pompier volontaire"
  ];
  birthday: Date = new Date("2004-07-30");

  get age(): number {
    let age: number = new Date().getFullYear() - this.birthday.getFullYear();
    if (new Date().getMonth() < this.birthday.getMonth() || (new Date().getMonth() == this.birthday.getMonth() && new Date().getDate() < this.birthday.getDate())) {
      age--;
    }
    return age;
  }

}
