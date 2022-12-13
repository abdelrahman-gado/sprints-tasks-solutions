import { Component, Input } from '@angular/core';

@Component({
  selector: 'app-stars',
  templateUrl: './stars.component.html',
  styleUrls: ['./stars.component.css'],
})
export class StarsComponent {
  @Input() rating: number = 0;
  @Input() count: number = 0;
  @Input() center: boolean = true;

  getClass(r: number): string {
    if (this.rating >= r) {
      return 'fa fa-star text-primary mr-1';
    } else if (Math.abs(this.rating - r) == 0.5) {
      return 'fa fa-star-half-alt text-primary mr-1';
    } else {
      return 'far fa-star text-primary mr-1';
    }
  }
}
