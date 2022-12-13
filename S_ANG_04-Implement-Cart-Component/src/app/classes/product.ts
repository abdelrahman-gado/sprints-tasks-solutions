export class Product {
  _id: string;
  name: string;
  image: string;
  category_id: string;
  price: number;
  discount: number;
  rating: number;
  rating_count: number;
  is_featured: boolean;
  is_recent: boolean;
  description: string;
  color: string;
  size: string;

  constructor(
    _id: string,
    name: string,
    image: string,
    category_id: string,
    price: number,
    discount: number,
    rating: number,
    rating_count: number,
    is_featured: boolean,
    is_recent: boolean,
    description: string,
    color: string,
    size: string
  ) {
    this._id = _id;
    this.name = name;
    this.image = image;
    this.category_id = category_id;
    this.price = price;
    this.discount = discount;
    this.rating = rating;
    this.rating_count = rating_count;
    this.is_featured = is_featured;
    this.is_recent = is_recent;
    this.color = color;
    this.description = description;
    this.size = size;
  }

}
