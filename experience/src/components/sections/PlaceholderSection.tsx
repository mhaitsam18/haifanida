export default function PlaceholderSection({
  index,
  title,
  note,
}: {
  index: number;
  title: string;
  note: string;
}) {
  return (
    <section className="relative flex min-h-screen w-full flex-col items-center justify-center gap-4 border-t border-beige/10 bg-void px-6 text-center">
      <span className="font-sans text-xs uppercase tracking-[0.4em] text-gold/70">
        Section {index}
      </span>
      <h2 className="font-display text-4xl italic text-ivory sm:text-6xl">
        {title}
      </h2>
      <p className="max-w-md font-sans text-sm text-cream/60">{note}</p>
    </section>
  );
}
