export interface Committee {
  id: number;
  slug: string;
  name: string;
  description: string;
  memberCount: number;
  category?: string;
  parentId?: number | null;
  children?: Committee[];
}

export interface Program {
  id: number;
  slug: string;
  title: string;
  excerpt: string;
  category: string;
  status: "upcoming" | "active" | "completed";
  startDate: string;
  endDate?: string;
  image?: string;
  location?: string;
}

export interface Post {
  id: number;
  slug: string;
  title: string;
  excerpt: string;
  body?: string;
  category: string;
  tags?: string[];
  publishedAt: string;
  readMinutes: number;
  cover?: string;
  author: { name: string; avatar?: string; role?: string };
}

export interface Testimonial {
  id: number;
  quote: string;
  name: string;
  role: string;
  avatar?: string;
}

export interface NavLink {
  label: string;
  href: string;
}
