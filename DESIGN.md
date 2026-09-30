---
name: Naufal Tsaqif Engineering Portfolio
description: High-craft architectural monograph and kinetic developer portfolio
colors:
  primary: "#3b82f6"
  neutral-bg: "#0d0d0d"
  neutral-bg-soft: "#121212"
  neutral-bg-elev: "#171717"
  neutral-text: "#f0f0f0"
  neutral-text-soft: "#cccccc"
  neutral-heading: "#ffffff"
  neutral-muted: "#888888"
  border: "rgba(255, 255, 255, 0.15)"
  border-subtle: "rgba(255, 255, 255, 0.08)"
typography:
  display:
    fontFamily: "Mixtape Extra Condensed, Outfit, ui-sans-serif, system-ui, sans-serif"
    fontSize: "clamp(3rem, 10vw, 6rem)"
    fontWeight: 900
    lineHeight: 0.88
    letterSpacing: "-0.04em"
  headline:
    fontFamily: "Mixtape Extra Condensed, Outfit, ui-sans-serif, system-ui, sans-serif"
    fontSize: "clamp(2rem, 5vw, 3.5rem)"
    fontWeight: 800
    lineHeight: 0.95
    letterSpacing: "-0.02em"
  title:
    fontFamily: "Manrope, Outfit, ui-sans-serif, system-ui, sans-serif"
    fontSize: "1.25rem"
    fontWeight: 600
    lineHeight: 1.3
    letterSpacing: "-0.01em"
  body:
    fontFamily: "Manrope, ui-sans-serif, system-ui, sans-serif"
    fontSize: "0.9375rem"
    fontWeight: 400
    lineHeight: 1.6
    letterSpacing: "normal"
  label:
    fontFamily: "ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace"
    fontSize: "0.6875rem"
    fontWeight: 500
    lineHeight: 1.2
    letterSpacing: "0.2em"
rounded:
  sm: "4px"
  md: "8px"
  lg: "12px"
  xl: "16px"
  full: "9999px"
spacing:
  xs: "4px"
  sm: "8px"
  md: "16px"
  lg: "24px"
  xl: "32px"
  xxl: "48px"
components:
  button-primary:
    backgroundColor: "{colors.neutral-heading}"
    textColor: "{colors.neutral-bg}"
    rounded: "{rounded.full}"
    padding: "14px 24px"
  button-secondary:
    backgroundColor: "transparent"
    textColor: "{colors.neutral-heading}"
    rounded: "{rounded.full}"
    padding: "14px 24px"
---

# Design System: Naufal Tsaqif Engineering Portfolio

## Overview

**Creative North Star: "The Architectural Monograph Dossier"**

An editorial, high-craft digital monograph designed to showcase full-stack engineering and spatial creative technology. Rejecting standard SaaS portfolio templates, the system draws inspiration from luxury architectural folios, museum archives, and precision laboratory instruments. Deep obsidian voids, razor-sharp hairlines, and monumental typography create an uncompromisingly cinematic stage where interactive prototypes and real technical case studies lead the viewer.

**Key Characteristics:**
- Unforgiving typographic discipline with ultra-condensed display scale paired with spacious geometric sans body.
- Deep obsidian foundation with purposeful electric cobalt focal points and luminous live telemetry indicators.
- Asymmetric architectural layouts pairing dense data rails with generous negative space.
- Kinetic differential scroll scrub orchestrated via GSAP, giving media frames weight and physical presence.

## Colors

A high-contrast dark aesthetic palette grounded in deep carbon and obsidian neutrals with surgical cobalt focal accents.

### Primary
- **Signal Cobalt** (#3b82f6): Used exclusively for active focus points, live telemetry status dots, and cursor accents. Never used as large background washes.

### Neutral
- **Obsidian Ground** (#0d0d0d): The universal background canvas, absorbing light and anchoring contrast.
- **Carbon Soft** (#121212): Surface layer for secondary structural cards and container modules.
- **Pure White** (#ffffff): Reserved for high-impact display titles, hero statements, and active action text.
- **Vellum Text** (#f0f0f0): Main readable body text delivering verified 14:1 contrast on Obsidian.
- **Muted Zinc** (#888888): Secondary labels, timestamps, metadata, and directional hints.
- **Hairline Border** (rgba(255, 255, 255, 0.08)): Subtle geometric partition lines providing architectural definition without heavy visual noise.

### Named Rules
**The Surgical Accent Rule.** Cobalt (#3b82f6) occupies ≤3% of any viewport. Its scarcity is what gives it authoritative focus.

## Typography

**Display Font:** Mixtape Extra Condensed / Outfit (with ui-sans-serif fallback)
**Body Font:** Manrope (with system-ui fallback)
**Label/Mono Font:** ui-monospace / SFMono-Regular

**Character:** Bold, brutalist architectural headers contrasted against warm, highly legible geometric humanism for narrative copy.

### Hierarchy
- **Display** (900, clamp(3rem, 10vw, 6rem), 0.88): Monumental typographic declarations; uppercase, tracking -0.04em.
- **Headline** (800, clamp(2rem, 5vw, 3.5rem), 0.95): Major section titles; uppercase, tracking -0.02em.
- **Title** (600, 1.25rem, 1.3): Case study titles and card headers.
- **Body** (400, 0.9375rem, 1.6): Narrative prose and descriptions, constrained to 50–65ch measure.
- **Label** (500, 0.6875rem, 0.2em tracking): Metadata rails, coordinates, and technical tags in monospace caps.

### Named Rules
**The Eyebrow Ban Rule.** Section titles carry their own gravity. Banned decorative prefixes ("01 / INDEX") are replaced with functional metadata rails.

## Layout

A 12-column asymmetric spatial grid with generous vertical rhythm (80px to 144px between macro-sections). Content modules span 7 columns for typographic narrative and 5 columns for architectural media frames. Responsive breakpoints at 640px (sm), 768px (md), 1024px (lg), and 1280px (xl), collapsing multi-column spreads into clean vertical progressions without losing media framing.

## Elevation & Depth

Surfaces prioritize tonal layering and fine architectural hairlines over diffuse shadow halos. Depth is articulated physically through GSAP parallax scrub where foreground media shifts relative to background grids.

### Shadow Vocabulary
- **Dossier Frame Shadow** (`box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6)`): Grounds photographic containers against the obsidian backdrop.
- **Glass Overlay Blur** (`backdrop-filter: blur(12px)`): Floats telemetry badges inside photo frames with ambient translucency.

## Shapes

- **Architectural Radii**: 16px (`rounded-2xl`) for primary media containers; 12px (`rounded-xl`) for internal data cards; 9999px (`rounded-full`) for buttons and badge pills.
- **Borders**: 1px crisp hairlines (`rgba(255, 255, 255, 0.08)`) with zero offset.

## Components

### Buttons
- **Shape**: Full pill (`rounded-full`, 9999px radius).
- **Primary**: Solid Pure White background (`#ffffff`), Obsidian dark text (`#0d0d0d`), padding 14px 24px, uppercase text-xs with 0.05em tracking.
- **Secondary/Ghost**: Transparent ground, 1px Hairline Border (`rgba(255, 255, 255, 0.15)`), white text, subtle hover lift.

### Architectural Dossier Frame
- **Aspect Ratio**: 4:5 vertical portrait aspect with internal overflow hidden.
- **Media**: Cover-fitted photography with 10% overflow buffer to support GSAP differential scrub without edge clipping.
- **Overlays**: Top coordinate badge and bottom glassmorphic dossier badge with blur.

### Telemetry Badges
- **Shape**: 12px rounded rectangle (`rounded-xl`) with 1px border and 2% white surface wash.
- **Content**: Monospace label atop semibold title and descriptive caption.

## Do's and Don'ts

### Do:
- **Do** preserve the 4:5 portrait aspect ratio for the dossier photographic container.
- **Do** maintain strict monochrome contrast for narrative copy (minimum 4.5:1 ratio).
- **Do** use live status indicators (emerald pulsing dot) for authentic availability signals.
- **Do** calibrate GSAP scrub speeds to feel organic and responsive to scroll velocity.

### Don't:
- **Don't** reintroduce fake floor oval shadows or cutout standee silhouettes on rectangular photography.
- **Don't** use decorative gradient text fills; emphasis is achieved through weight and scale.
- **Don't** crowd display typography; ensure line-height remains tightly disciplined (0.86–0.95) with adequate bottom breathing room.
