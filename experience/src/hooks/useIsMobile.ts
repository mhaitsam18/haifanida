"use client";

import { useSyncExternalStore } from "react";

function subscribeFactory(breakpointPx: number) {
  return (callback: () => void) => {
    const query = window.matchMedia(`(max-width: ${breakpointPx}px)`);
    query.addEventListener("change", callback);
    return () => query.removeEventListener("change", callback);
  };
}

function getServerSnapshot() {
  return false;
}

/** SSR-safe (false on the server), tracks resizes across the breakpoint. */
export function useIsMobile(breakpointPx = 768): boolean {
  return useSyncExternalStore(
    subscribeFactory(breakpointPx),
    () => window.matchMedia(`(max-width: ${breakpointPx}px)`).matches,
    getServerSnapshot
  );
}
