import Hero from "@/components/hero/Hero";
import PlaceholderSection from "@/components/sections/PlaceholderSection";

const UPCOMING_SECTIONS = [
  { title: "Introduction", note: "Transition through clouds toward Masjid Nabawi." },
  { title: "About Haifa", note: "Company story, sourced from live Konten data." },
  { title: "Why Choose Haifa", note: "Feature grid, staggered cinematic reveal." },
  { title: "Travel Packages", note: "Real packages, card tilts into 3D on hover." },
  { title: "Hotel Showcase", note: "Real hotel data, stylized 3D accent on hover." },
  { title: "Transportation", note: "Bus & flight legs, hover reveals live details." },
  { title: "Testimonials", note: "Needs a new public API endpoint — Phase 3." },
  { title: "Departure Schedule", note: "Upcoming published packages by tanggal_mulai." },
  { title: "Call To Action", note: "WhatsApp + handoff into the Laravel booking flow." },
];

export default function Home() {
  return (
    <main>
      <Hero />
      {UPCOMING_SECTIONS.map((section, i) => (
        <PlaceholderSection
          key={section.title}
          index={i + 2}
          title={section.title}
          note={section.note}
        />
      ))}
    </main>
  );
}
