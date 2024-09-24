import { Component } from '@angular/core';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [],
  templateUrl: './home.component.html',
  styleUrl: './home.component.scss'
})
export class HomeComponent {

  firstName: string = "Valentin";
  lastName: string = "THUILLIER";
  profession: string = "Développeur back-end"

}
