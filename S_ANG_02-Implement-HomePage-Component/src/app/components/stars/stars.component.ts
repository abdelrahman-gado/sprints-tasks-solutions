import { Component, Input } from '@angular/core';

@Component({
  selector: 'app-stars',
  templateUrl: './stars.component.html',
  styleUrls: ['./stars.component.css']
})
export class StarsComponent {
  @Input() rating_count: number = 0;
  @Input() rating: number = 0;


  getStarClass(r: number) {
    if (this.rating >= r) {
      return 'fa fa-star text-primary mr-1';
    } else if (Math.floor(Math.abs(r - this.rating)) === 0) {
      return 'fas fa-star-half text-primary mr-1';
    } else {
      return 'far fa-star text-primary mr-1';
    }
  }
}
