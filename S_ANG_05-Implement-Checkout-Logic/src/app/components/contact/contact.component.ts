import { Component } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-contact',
  templateUrl: './contact.component.html',
  styleUrls: ['./contact.component.css']
})
export class ContactComponent {

  contactForm = new FormGroup({
    name: new FormControl("", [Validators.required, Validators.minLength(3)]),
    email: new FormControl("", [Validators.required, Validators.email]),
    subject: new FormControl("", [Validators.required]),
    message: new FormControl("", [Validators.required])
  });

  constructor(private router: Router) {}


  submitContactForm() {
    if (this.contactForm.valid) {
      alert("We have received your message successfully..");
      this.router.navigate(['/home']);
    }
  }

  get c() {
    return this.contactForm.controls;
  }
}
