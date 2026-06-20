import type { Committee, Program, Post, Testimonial } from "@/types/public";

export const demoCommittees: Committee[] = [
  {
    id: 1, slug: "board-of-trustees", name: "Board of Trustees", category: "Governance",
    description: "Strategic oversight and long-term direction for UnitySphere worldwide.",
    memberCount: 12,
    children: [
      { id: 11, slug: "executive-committee", name: "Executive Committee", category: "Governance",
        description: "Day-to-day decisions and policy execution.", memberCount: 7, parentId: 1,
        children: [
          { id: 111, slug: "finance-subcommittee", name: "Finance Subcommittee", category: "Finance",
            description: "Budget, audits, and financial planning.", memberCount: 5, parentId: 11 },
          { id: 112, slug: "ethics-subcommittee", name: "Ethics Subcommittee", category: "Compliance",
            description: "Code of conduct and ethical review.", memberCount: 4, parentId: 11 },
        ]
      },
      { id: 12, slug: "advisory-council", name: "Advisory Council", category: "Strategy",
        description: "External experts guiding strategic initiatives.", memberCount: 9, parentId: 1 },
    ],
  },
  {
    id: 2, slug: "programs-committee", name: "Programs Committee", category: "Operations",
    description: "Designs, launches, and evaluates all community programs.", memberCount: 18,
    children: [
      { id: 21, slug: "education-working-group", name: "Education Working Group", category: "Education",
        description: "K-12 and adult learning initiatives.", memberCount: 11, parentId: 2 },
      { id: 22, slug: "health-working-group", name: "Health Working Group", category: "Health",
        description: "Public health outreach and partnerships.", memberCount: 8, parentId: 2 },
    ],
  },
  {
    id: 3, slug: "community-engagement", name: "Community Engagement", category: "Outreach",
    description: "Builds bridges between chapters, members, and partners.", memberCount: 22,
  },
  {
    id: 4, slug: "technology-committee", name: "Technology Committee", category: "Technology",
    description: "Digital infrastructure, data, and member platforms.", memberCount: 9,
  },
];

export function flattenCommittees(list: Committee[]): Committee[] {
  const out: Committee[] = [];
  const walk = (items: Committee[]) => items.forEach(i => { out.push(i); if (i.children) walk(i.children); });
  walk(list);
  return out;
}

export const demoPrograms: Program[] = [
  { id: 1, slug: "youth-leadership-2026", title: "Youth Leadership Academy 2026", excerpt: "A six-month immersive program training 200 young leaders across 14 countries.", category: "Leadership", status: "upcoming", startDate: "2026-09-01", endDate: "2027-02-28", location: "Hybrid" },
  { id: 2, slug: "clean-water-initiative", title: "Clean Water Initiative", excerpt: "Bringing safe drinking water infrastructure to underserved communities.", category: "Health", status: "active", startDate: "2025-03-12", location: "East Africa" },
  { id: 3, slug: "digital-literacy-drive", title: "Digital Literacy Drive", excerpt: "Equipping 10,000 adults with foundational digital and AI skills.", category: "Education", status: "active", startDate: "2025-01-20", location: "Global" },
  { id: 4, slug: "climate-action-summit", title: "Climate Action Summit", excerpt: "Annual gathering of grassroots climate leaders and policymakers.", category: "Environment", status: "upcoming", startDate: "2026-10-14", endDate: "2026-10-17", location: "Geneva" },
  { id: 5, slug: "small-business-mentorship", title: "Small Business Mentorship", excerpt: "Pairing entrepreneurs with seasoned mentors across our network.", category: "Economic", status: "active", startDate: "2024-11-01", location: "Online" },
  { id: 6, slug: "civic-tech-fellowship", title: "Civic Tech Fellowship", excerpt: "Fellows build open-source tools that strengthen democratic participation.", category: "Technology", status: "completed", startDate: "2024-02-01", endDate: "2025-01-31", location: "Remote" },
];

export const demoPosts: Post[] = [
  { id: 1, slug: "rebuilding-trust-in-community", title: "Rebuilding trust in community institutions", excerpt: "How transparent governance and listening tours changed our member retention by 38%.", category: "Insights", tags: ["governance","trust"], publishedAt: "2026-05-22", readMinutes: 7, author: { name: "Amara Okafor", role: "Director of Programs" } },
  { id: 2, slug: "ai-for-non-profits", title: "AI for non-profits: a pragmatic playbook", excerpt: "Five high-leverage uses of AI for small teams — without sacrificing your mission.", category: "Technology", tags: ["ai","strategy"], publishedAt: "2026-04-30", readMinutes: 9, author: { name: "Hiroshi Tanaka", role: "CTO" } },
  { id: 3, slug: "field-notes-east-africa", title: "Field notes from the Clean Water Initiative", excerpt: "Lessons from twelve months on the ground with local partners.", category: "Field Notes", tags: ["health","field"], publishedAt: "2026-04-12", readMinutes: 6, author: { name: "Lena Müller", role: "Field Lead" } },
  { id: 4, slug: "designing-for-belonging", title: "Designing membership experiences that feel like belonging", excerpt: "Behind the redesign of our member portal — and the principles we kept refusing to compromise.", category: "Design", tags: ["design","members"], publishedAt: "2026-03-28", readMinutes: 8, author: { name: "Priya Raman", role: "Head of Design" } },
  { id: 5, slug: "year-in-review-2025", title: "Year in review: 2025", excerpt: "Numbers, stories, and what we learned across 31 countries this year.", category: "Reports", tags: ["report"], publishedAt: "2026-01-15", readMinutes: 12, author: { name: "Board of Trustees" } },
  { id: 6, slug: "volunteer-spotlight", title: "Volunteer spotlight: the quiet engine of every program", excerpt: "Three stories that captured what makes our network special.", category: "Stories", tags: ["volunteers"], publishedAt: "2025-12-19", readMinutes: 5, author: { name: "Community Team" } },
];

export const demoTestimonials: Testimonial[] = [
  { id: 1, quote: "UnitySphere gave our chapter the structure we'd been missing for years. Membership doubled in eighteen months.", name: "Sarah Chen", role: "Chapter Lead, Singapore" },
  { id: 2, quote: "The programs platform turned what used to take a team of five into something a single coordinator can run cleanly.", name: "Marcus Johnson", role: "Director, US Midwest" },
  { id: 3, quote: "It's rare to find software that respects how community work actually happens. UnitySphere does.", name: "Fatima Al-Hassan", role: "Regional Coordinator, MENA" },
];

export const demoStats = [
  { label: "Active committees", value: 142 },
  { label: "Members worldwide", value: 38450 },
  { label: "Programs launched", value: 312 },
  { label: "Countries reached", value: 47 },
];
