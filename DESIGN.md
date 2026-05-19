# Design System Inspired by Saweria

## 1. Visual Theme & Atmosphere

Saweria embodies a playful, approachable digital ecosystem designed to bridge creators with their communities through seamless financial interaction. The design radiates warmth and accessibility, blending soft, rounded aesthetics with vibrant accent colors that evoke joy and trust. The visual language is informal yet professional, featuring whimsical character illustrations alongside clean, functional UI elements. The palette draws from warm oranges, soft teals, and gentle pastels, creating an inviting atmosphere that feels friendly rather than corporate. This is a design system for the Indonesian/Southeast Asian creator economy—accessible, supportive, and community-focused.

**Key Characteristics**
- Warm, approachable character-driven design with playful animal mascots
- Soft, rounded forms emphasizing friendliness and trust
- High contrast between neutral dark text and vibrant accent colors
- Clean, monospace typography for technical credibility
- Gentle color palette dominated by soft teals, warm oranges, and light grays
- Emphasis on clarity and ease of use for financial transactions
- Illustrated UI elements paired with minimalist interaction patterns

## 2. Color Palette & Roles

### Primary

- **Primary Dark** (`#1A202C`): Dominant text color for headings, body copy, and primary UI text; establishes hierarchy and readability across the interface
- **Primary Text Black** (`#000000`): Secondary text color for links, body content, and high-contrast elements

### Accent Colors

- **Warm Orange** (`#DD6B20`): Call-to-action buttons (Daftar/Register), secondary highlights, and interactive hover states
- **Vibrant Golden** (`#FAAE2B`): Warning states, alerts, and important informational elements
- **Soft Teal** (`#8BD3DD`): Primary accent for login elements, highlights, and calming interactive states
- **Soft Pink** (`#FE98A3`): Decorative accent paired with character illustrations; secondary call-to-action support
- **Light Pink Background** (`#FFBDC4`): Soft background fills and subtle UI containers

### Interactive

- **Danger Red** (`#E53E3E`): Error states and critical alerts
- **Dark Danger Red** (`#C53030`): Hover and pressed states for error conditions
- **Button Hover Orange** (`#DD6B20`): Interactive state enhancement for primary actions

### Neutral Scale

- **Light Gray Surface** (`#E2E8F0`): Secondary backgrounds, card surfaces, and container fills; the most frequently used neutral
- **Lighter Gray** (`#F2F7F5`): Subtle background differentiation and inactive states
- **Very Light Gray** (`#F7FAFC`): Lightest background tier for nested containers
- **Light Blue Gray** (`#E8F4F9`): Soft background for information containers
- **Medium Gray** (`#A0AEC0`): Secondary text, disabled states, and subtle borders
- **Dark Gray** (`#718096`): Tertiary text, helper text, and muted information

### Surface & Borders

- **Border Gray** (`#E2E8F0`): Default border color for containers, input fields, and dividers
- **Surface White** (`#FFFFFF`): Card backgrounds, modal surfaces, and elevated containers
- **Text Gray Dark** (`#222222`): Alternative dark text for contrast
- **Text Gray Darker** (`#333333`): Emphasis text and bold labels

### Shadow & Depth

- **Black Transparent** (`#0000` with opacity): Used for subtle shadow and overlay effects on UI components

## 3. Typography Rules

### Font Family

**Primary:** Comfortaa, sans-serif (rounded, friendly, humanistic)
**Secondary:** IBM Plex Mono, monospace (technical, clear, monospace emphasis)
**Fallback stacks:**
- Comfortaa: `"Comfortaa", "Trebuchet MS", sans-serif`
- IBM Plex Mono: `"IBM Plex Mono", "Courier New", monospace`

### Hierarchy

| Role | Font | Size | Weight | Line Height | Letter Spacing | Notes |
|------|------|------|--------|-------------|-----------------|-------|
| Display | Comfortaa | 48px | 300 | 57.6px | 0px | Main page hero heading; light weight creates elegant scale |
| Heading 3 | Comfortaa | 30px | 800 | 36px | 0px | Section headers; bold weight for emphasis |
| Body | IBM Plex Mono | 16px | 400 | 24px | 0px | Primary body text; monospace for clarity |
| List Item | IBM Plex Mono | 20px | 400 | 30px | 0px | List content and feature descriptions |
| Link | IBM Plex Mono | 16px | 400 | 24px | 0px | Inline and standalone links |
| Small Text | IBM Plex Mono | 14px | 400 | 21px | 0px | Caption, helper text, and secondary information |
| Button Text | IBM Plex Mono | 16px | 400 | 24px | 0px | Interactive button labels |

### Principles

- **Warmth through rounded letterforms:** Comfortaa's humanistic design creates an approachable, welcoming atmosphere
- **Technical clarity:** IBM Plex Mono provides trustworthy, readable body content and transaction-related information
- **Weight contrast:** Light display (300) versus bold headings (800) creates strong visual hierarchy
- **Generosity in line height:** 1.5× to 1.6× multipliers ensure comfortable reading of financial information
- **No letter spacing:** Maintains natural word spacing and prevents awkward gaps in monospace text
- **Consistent sizing:** Limited palette of sizes (14px, 16px, 20px, 30px, 48px) enforces visual consistency

## 4. Component Stylings

### Buttons

#### Primary Button (CTA - Daftar/Register)

```
Background: #DD6B20
Text Color: #FFFFFF
Padding: 12px 24px
Border Radius: 8px
Border: 2px solid #DD6B20
Font: IBM Plex Mono, 16px, 400
Line Height: 24px
Box Shadow: 0px 4px 12px rgba(221, 107, 32, 0.3)
Hover State:
  Background: #C05A1A
  Border: 2px solid #C05A1A
  Box Shadow: 0px 6px 16px rgba(221, 107, 32, 0.4)
Active State:
  Background: #B84F16
  Box Shadow: 0px 2px 8px rgba(221, 107, 32, 0.2)
Disabled State:
  Background: #A0AEC0
  Border: 2px solid #A0AEC0
  Text Color: #718096
  Box Shadow: none
  Cursor: not-allowed
```

#### Secondary Button (Login)

```
Background: #8BD3DD
Text Color: #1A202C
Padding: 12px 24px
Border Radius: 8px
Border: 2px solid #8BD3DD
Font: IBM Plex Mono, 16px, 400
Line Height: 24px
Box Shadow: 0px 4px 12px rgba(139, 211, 221, 0.3)
Hover State:
  Background: #6ABCC4
  Border: 2px solid #6ABCC4
  Box Shadow: 0px 6px 16px rgba(139, 211, 221, 0.4)
Active State:
  Background: #5BA7B4
  Box Shadow: 0px 2px 8px rgba(139, 211, 221, 0.2)
```

#### Ghost Button (Navigation/Help)

```
Background: transparent
Text Color: #1A202C
Padding: 12px 24px
Border Radius: 8px
Border: 2px solid #1A202C
Font: IBM Plex Mono, 16px, 400
Line Height: 24px
Box Shadow: none
Hover State:
  Background: #F7FAFC
  Border: 2px solid #1A202C
  Box Shadow: 0px 2px 8px rgba(26, 32, 44, 0.1)
Active State:
  Background: #E2E8F0
  Box Shadow: 0px 1px 4px rgba(26, 32, 44, 0.08)
```

### Cards & Containers

#### Information Card

```
Background: #E8F4F9
Border: 1px solid #E2E8F0
Border Radius: 12px
Padding: 16px 20px
Box Shadow: 0px 2px 8px rgba(0, 0, 0, 0.06)
Text Color: #1A202C
Font: IBM Plex Mono, 16px, 400
Line Height: 24px
Transition: box-shadow 0.2s ease-in-out, background-color 0.2s ease-in-out
Hover State (optional):
  Box Shadow: 0px 4px 12px rgba(0, 0, 0, 0.1)
```

#### Elevated Card

```
Background: #FFFFFF
Border: 1px solid #E2E8F0
Border Radius: 12px
Padding: 20px
Box Shadow: 0px 4px 16px rgba(0, 0, 0, 0.08)
Text Color: #1A202C
```

#### Light Surface Container

```
Background: #F2F7F5
Border: 1px solid #E2E8F0
Border Radius: 8px
Padding: 12px 16px
Box Shadow: none
Text Color: #222222
```

### Inputs & Forms

#### Text Input Default State

```
Background: #FFFFFF
Border: 2px solid #E2E8F0
Border Radius: 8px
Padding: 12px 16px
Font: IBM Plex Mono, 16px, 400
Text Color: #1A202C
Line Height: 24px
Box Shadow: none
Placeholder Color: #A0AEC0
Transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out
```

#### Text Input Focus State

```
Background: #FFFFFF
Border: 2px solid #8BD3DD
Border Radius: 8px
Padding: 12px 16px
Box Shadow: 0px 0px 0px 3px rgba(139, 211, 221, 0.2)
Outline: none
```

#### Text Input Error State

```
Background: #FFFFFF
Border: 2px solid #E53E3E
Border Radius: 8px
Padding: 12px 16px
Box Shadow: 0px 0px 0px 3px rgba(229, 62, 62, 0.15)
```

#### Text Input Disabled State

```
Background: #F7FAFC
Border: 2px solid #E2E8F0
Border Radius: 8px
Padding: 12px 16px
Text Color: #718096
Cursor: not-allowed
Opacity: 0.6
```

#### Form Label

```
Font: IBM Plex Mono, 14px, 400
Text Color: #1A202C
Margin Bottom: 8px
Line Height: 21px
Font Weight: 600
Display: block
```

#### Form Helper Text

```
Font: IBM Plex Mono, 12px, 400
Text Color: #718096
Margin Top: 4px
Line Height: 18px
```

### Navigation

#### Navigation Link Default

```
Background: transparent
Text Color: #1A202C
Font: IBM Plex Mono, 16px, 400
Line Height: 24px
Padding: 8px 12px
Border Radius: 4px
Border: none
Box Shadow: none
Text Decoration: none
Cursor: pointer
Transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out
```

#### Navigation Link Hover

```
Background: #F2F7F5
Text Color: #1A202C
Box Shadow: none
```

#### Navigation Link Active

```
Background: #E2E8F0
Text Color: #1A202C
Border Bottom: 3px solid #DD6B20
```

### Tabs

#### Tab Default

```
Background: #F7FAFC
Text Color: #718096
Font: IBM Plex Mono, 14px, 400
Padding: 12px 16px
Border: none
Border Bottom: 3px solid transparent
Border Radius: 0px
Cursor: pointer
Transition: all 0.2s ease-in-out
```

#### Tab Active

```
Background: #FFFFFF
Text Color: #1A202C
Border Bottom: 3px solid #DD6B20
Font Weight: 600
```

#### Tab Hover

```
Background: #E8F4F9
```

### Badges

#### Badge - Warning

```
Background: #FAAE2B
Text Color: #FFFFFF
Padding: 4px 12px
Border Radius: 16px
Font: IBM Plex Mono, 12px, 600
Line Height: 18px
Border: none
Display: inline-block
```

#### Badge - Error

```
Background: #E53E3E
Text Color: #FFFFFF
Padding: 4px 12px
Border Radius: 16px
Font: IBM Plex Mono, 12px, 600
Line Height: 18px
Border: none
```

#### Badge - Success

```
Background: #22A447
Text Color: #FFFFFF
Padding: 4px 12px
Border Radius: 16px
Font: IBM Plex Mono, 12px, 600
Line Height: 18px
```

## 5. Layout Principles

### Spacing System

**Base Unit:** 4px

**Scale with usage contexts:**
- **Extra Small (4px):** Micro-interactions, icon spacing within components
- **Small (8px):** Tight component spacing, button padding
- **Medium (12px):** Standard padding, margin between adjacent elements
- **Standard (16px):** Primary padding for containers, margin around content blocks
- **Large (20px):** Margin between major sections
- **Extra Large (32px):** Section spacing, top/bottom padding for full-width containers
- **XXL (48px):** Hero spacing, large content area padding

**Usage patterns:**
- Buttons: `12px 24px` (vertical × horizontal)
- Card padding: `16px 20px` or `20px`
- Section margins: `32px 0px`
- Container padding: `48px`

### Grid & Container

- **Max Width:** 1200px for content containers
- **Column Strategy:** 12-column grid on desktop; flexible single-column on mobile
- **Section Pattern:** Full-width background containers with centered 1200px max-width content
- **Gutter:** 16px between columns
- **Padding:** 48px on desktop (sides), 20px on tablet, 16px on mobile

### Whitespace Philosophy

Generous whitespace creates breathing room and visual clarity. Content sections are separated by 32px vertical margins, allowing the eye to rest between distinct information groups. Cards and containers maintain consistent internal padding (16px–20px) to prevent content from feeling cramped. The interface avoids visual clutter through strategic use of light neutral backgrounds and ample margin between interactive elements. Whitespace around buttons and form elements prevents accidental interaction and enhances usability.

### Border Radius Scale

- **None (0px):** Navigation elements, full-width dividers, utility borders
- **Small (4px):** Small icons, subtle UI accents
- **Medium (8px):** Input fields, ghost buttons, form containers, small cards
- **Large (12px):** Standard cards, elevated containers, information blocks
- **Extra Large (16px):** Modal dialogs, large call-to-action sections, hero containers
- **Rounded (20px+):** Badges, pills, avatar containers

## 6. Depth & Elevation

| Level | Treatment | Use |
|-------|-----------|-----|
| Flat (No Shadow) | None | Text elements, navigation, secondary buttons, disabled states |
| Subtle Lift | `0px 2px 8px rgba(0, 0, 0, 0.06)` | Default card elevation, subtle interactive feedback, info containers |
| Elevated | `0px 4px 16px rgba(0, 0, 0, 0.08)` | Primary cards, hovered elements, standard UI containers |
| High Elevation | `0px 6px 20px rgba(0, 0, 0, 0.12)` | Modal dialogs, floating action buttons, overlay surfaces |
| Emphasis Shadow | `0px 4px 12px rgba([color], 0.3)` | Colored button shadows (Orange: `rgba(221, 107, 32, 0.3)`, Teal: `rgba(139, 211, 221, 0.3)`) |

**Shadow Philosophy:**
Shadows are used sparingly to create depth hierarchy without visual noise. Interactive elements employ color-tinted shadows that reflect their brand color, creating visual coherence. Hover states intensify shadows (`0px 6px 16px` with increased opacity) to signal affordance. Disabled and inactive states flatten (no shadow) to reduce perceived interactivity. All shadows use soft black with reduced opacity (6%–12%) for a contemporary, light aesthetic that suits the warm, approachable brand voice.

## 7. Do's and Don'ts

### Do

- **Use Comfortaa for all headings** and prominent text to establish the friendly, approachable brand voice
- **Apply IBM Plex Mono to body text and links** for technical credibility and transaction clarity
- **Leverage the warm orange (#DD6B20)** for primary CTAs and success states to draw attention
- **Employ soft teal (#8BD3DD)** as a calming secondary accent for authentication flows
- **Maintain 1.5× or greater line height** on all body and list text for optimal readability
- **Use ample whitespace** (minimum 12px between interactive elements) to prevent accidental touches
- **Color-code interactive states:** hover (lighter/tinted), active (saturated), disabled (grayed)
- **Apply consistent border radii:** 8px for standard inputs/buttons, 12px for cards, 16px for modals
- **Use light neutrals (#E2E8F0, #F7FAFC)** as secondary backgrounds to avoid visual overwhelm
- **Include animated transitions** (0.2s ease-in-out) on hover and focus states for smooth feedback

### Don't

- **Never reverse text color contrast:** Light text on light backgrounds or dark text on dark backgrounds
- **Avoid using more than three accent colors** in a single view; stick to orange, teal, and pink for hierarchy
- **Don't remove focus indicators** from form inputs; always show a visible 3px ring on focus
- **Avoid shadows on disabled states**; flatness signals reduced interactivity
- **Never use serif fonts** for body or UI labels; reserved for decorative use only
- **Don't mix IBM Plex Mono weights** inconsistently; use 400 for body, 600 for emphasis
- **Avoid border radius greater than 16px** except for badges and avatar containers
- **Never apply full opacity blacks (#000000)** on colored backgrounds; use color-appropriate overlays
- **Don't crowd interactive elements;** minimum 12px padding around buttons prevents fat-finger errors
- **Avoid using warning yellow (#FAAE2B)** as a primary background; reserve for alerts and badges only
- **Don't combine multiple font families** on the same line; separate by semantic role
- **Never justify text:** Use left-align for body, center for headings; justified text breaks monospace flow

## 8. Responsive Behavior

### Breakpoints

| Breakpoint | Width | Key Changes |
|------------|-------|-------------|
| Mobile | 320px–599px | Single-column layout, 16px padding, 24px section margins, 30px display heading, stacked buttons |
| Tablet | 600px–1023px | Two-column grid, 24px padding, 32px section margins, 36px headings, 48px–60px hero section |
| Desktop | 1024px+ | 12-column grid, 48px padding, 48px section margins, full 1200px max-width, inline buttons |
| Large Desktop | 1440px+ | 64px side padding, 64px section margins, expanded spacing for large screens |

### Touch Targets

- **Minimum touch target size:** 44px × 44px for all interactive elements
- **Recommended size:** 48px × 48px for buttons and links
- **Spacing between targets:** Minimum 12px to prevent accidental interaction
- **Input field height:** 44px (12px padding + 20px text height)
- **Button padding:** 12px vertical × 24px horizontal (minimum 44px height)
- **Icon size:** 24px for standard icons, 32px for prominent actions

### Collapsing Strategy

- **Navigation:** Expands to horizontal menu on 1024px+; collapses to hamburger menu below 600px
- **Grid layout:** 12 columns on desktop → 6 columns on tablet → 1 column on mobile
- **Cards:** Full-width on mobile, 2-column on tablet (600px+), 3-column on desktop (1024px+)
- **Buttons:** Stack vertically on mobile (100% width), inline on 600px+ with 12px gap
- **Form inputs:** 100% width on mobile, side-by-side on 1024px+ (50% width each with 16px gap)
- **Heading sizes:** 30px on mobile, 36px on tablet, 48px on desktop
- **Body font:** 14px on mobile, 16px on tablet/desktop
- **Padding:** 16px on mobile, 24px on tablet, 48px on desktop
- **Section margins:** 20px on mobile, 32px on tablet, 48px on desktop

## 9. Agent Prompt Guide

### Quick Color Reference

- **Primary CTA:** Warm Orange (`#DD6B20`) — all "Daftar" and registration buttons
- **Secondary CTA:** Soft Teal (`#8BD3DD`) — login and authentication elements
- **Primary Text:** Primary Dark (`#1A202C`) — headings, labels, body copy
- **Background:** Light Gray (`#E2E8F0`) — secondary surfaces, containers
- **Surface:** White (`#FFFFFF`) — card backgrounds, modals
- **Error State:** Danger Red (`#E53E3E`) — validation errors, alerts
- **Warning State:** Vibrant Golden (`#FAAE2B`) — important notices, pricing details
- **Soft Accent:** Soft Pink (`#FE98A3`) — decorative elements, secondary highlights
- **Disabled Text:** Dark Gray (`#718096`) — inactive states, helper text
- **Borders:** Light Gray (`#E2E8F0`) — input borders, dividers, container edges

### Iteration Guide

1. **Always use Comfortaa for headings (48px display, 30px heading 3)** and IBM Plex Mono for body (16px) and lists (20px). Light weight (300) for display creates elegance; bold (800) for section headers creates emphasis.

2. **Primary call-to-actions must be Warm Orange (#DD6B20) with white text, 12px 24px padding, 8px border radius, and hover state darkening to #C05A1A.** Include `0px 4px 12px rgba(221, 107, 32, 0.3)` shadow by default.

3. **All interactive elements require visible focus states:** 2px border color shift and 3px ring on inputs (`box-shadow: 0px 0px 0px 3px rgba([color], 0.2)`). Never remove focus indicators.

4. **Use light neutral backgrounds (#E2E8F0 or #F7FAFC) for secondary containers;** reserve full white (#FFFFFF) for elevated cards and modals with 12px+ border radius.

5. **Form inputs require 2px borders (#E2E8F0 default, #8BD3DD focus, #E53E3E error), 12px 16px padding, 8px border radius, and monospace font (IBM Plex Mono, 16px).** Always include labels above inputs with 8px bottom margin.

6. **Spacing follows 4px base unit:** buttons use 12px V × 24px H, cards use 16px–20px padding, sections use 32px–48px margins. Maintain 1.5× line height minimum on all text (24px for 16px text).

7. **Ghost buttons must have transparent backgrounds, dark borders (#1A202C), and hover state background (#F7FAFC).** Never apply shadows to disabled states; flatten visual hierarchy with grayed color (#A0AEC0).

8. **Shadow hierarchy:** Flat (none) → Subtle (`0px 2px 8px rgba(0,0,0,0.06)`) → Elevated (`0px 4px 16px rgba(0,0,0,0.08)`) → High (`0px 6px 20px rgba(0,0,0,0.12)`). Color-tinted shadows for brand buttons reflect accent color.

9. **Responsive design:** 44px minimum touch targets, 16px mobile padding → 24px tablet → 48px desktop. Stack buttons vertically on mobile; inline on 1024px+. Typography: 30px heading 3 mobile → 36px tablet → 48px desktop display.

10. **Color-code element states consistently:** Default (brand color) → Hover (10% darker/lighter shift) → Active (20% shift) → Disabled (grayed #A0AEC0 background with #718096 text). Maintain 4.5:1 minimum contrast ratio for accessibility.