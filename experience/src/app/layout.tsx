import type { Metadata } from "next";
import { Cormorant_Garamond, Manrope } from "next/font/google";
import SmoothScroll from "@/components/providers/SmoothScroll";
import "./globals.css";

const cormorant = Cormorant_Garamond({
  variable: "--font-cormorant",
  subsets: ["latin"],
  weight: ["300", "400", "500", "600", "700"],
  style: ["normal", "italic"],
});

const manrope = Manrope({
  variable: "--font-manrope",
  subsets: ["latin"],
  weight: ["300", "400", "500", "600", "700"],
});

export const metadata: Metadata = {
  title: "Haifa Nida Wisata — Umrah, Haji & Wisata Halal",
  description:
    "Perjalanan ibadah yang menyentuh hati — Umrah, Haji, dan Wisata Halal bersama Haifa Nida Wisata.",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html
      lang="id"
      className={`${cormorant.variable} ${manrope.variable} h-full antialiased`}
    >
      <body className="min-h-full bg-void text-ivory">
        <SmoothScroll>{children}</SmoothScroll>
      </body>
    </html>
  );
}
