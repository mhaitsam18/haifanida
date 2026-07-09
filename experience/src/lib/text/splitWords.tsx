import { Fragment } from "react";

/**
 * Wraps each word in its own inline-block span with a data attribute GSAP
 * can target for staggered reveals. Deterministic and server-renderable —
 * no DOM measurement needed, unlike GSAP's (paid) SplitText plugin.
 */
export function splitWords(text: string, className?: string) {
  const words = text.split(" ");

  return words.map((word, index) => (
    <Fragment key={`${word}-${index}`}>
      <span
        data-word
        className={className}
        style={{ display: "inline-block", willChange: "transform, filter, opacity" }}
      >
        {word}
      </span>
      {index < words.length - 1 ? " " : ""}
    </Fragment>
  ));
}
