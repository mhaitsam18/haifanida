import type { NextConfig } from "next";
import path from "path";

const laravelUrl = process.env.NEXT_PUBLIC_LARAVEL_URL ?? "http://127.0.0.1:8000";
const laravelHost = new URL(laravelUrl);

const nextConfig: NextConfig = {
  // This app lives nested inside the Laravel repo, which has its own
  // package-lock.json — without this, Turbopack mis-detects that as the
  // workspace root instead of this directory.
  turbopack: {
    root: path.join(__dirname),
  },
  images: {
    remotePatterns: [
      {
        protocol: laravelHost.protocol.replace(":", "") as "http" | "https",
        hostname: laravelHost.hostname,
        port: laravelHost.port || undefined,
        pathname: "/storage/**",
      },
    ],
  },
};

export default nextConfig;
