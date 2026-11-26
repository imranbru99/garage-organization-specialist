# GridForge Garage Systems — Laravel 13 + Filament 3 ERP

Production-ready public website, Filament ERP, and AI assistants for **GridForge Garage Systems**, a Denver garage organization specialist serving wall tracks, overhead racks, custom cabinets, and full garage makeovers across the Front Range.

## Features
- 🏠 Premium public marketing site (hero, services, about, dashboard preview, contact)
- 🧰 Service detail pages for garage storage offerings
- 📰 Blog / knowledge content with seeded posts
- 📬 Contact form that stores leads in the database
- 💬 Floating WhatsApp button + public AI chatbot widget
- 🗂️ Filament 3 ERP at `/admin` (customers, jobs, inventory, invoices, payments, appointments)
- 👥 Roles: Admin, Manager, Staff
- 📊 Reports dashboard with stats and charts
- ⚙️ Settings page + AI Studio (content generator, automation suggestions, troubleshooting)
- 📚 Public knowledge base (guides, common issues, admin manual, troubleshooting)
- 🌱 Realistic demo seeders for a US SME workflow

## Tech Stack
- Laravel 13
- Filament 3
- Livewire + Alpine.js
- Tailwind-ready frontend + custom branded CSS
- SQLite (demo) / MySQL (production)
- OpenAI HTTP integration with Gemini config keys for fallback
- Spatie Laravel Permission

## Installation
```bash
git clone https://github.com/imranbru99/garage-organization-specialist.git
cd garage-organization-specialist
composer install
copy .env.example .env   # Windows
php artisan key:generate
# Ensure database/database.sqlite exists when using SQLite
php artisan migrate --seed
php artisan serve
```

Admin panel: `http://localhost:8000/admin`

Default admin login:
- Email: `admin@example.com`
- Password: `password`

Optional AI: set `OPENAI_API_KEY` in `.env`. Without a key, the chatbot and AI Studio use the built-in garage FAQ demo responses.

## Screenshots / Visual Dashboard
![Organized garage wall storage](https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=1400&q=80)

![Overhead rack workshop](https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=1400&q=80)

![Custom garage cabinets](https://images.unsplash.com/photo-1615874959474-d609969a20ed?auto=format&fit=crop&w=1400&q=80)

![Garage tools and zones](https://images.unsplash.com/photo-1504148455328-c376907d081c?auto=format&fit=crop&w=1400&q=80)

## Live Demo
Placeholder — deploy to your preferred host and share the public URL + `/admin` access for stakeholders.

## SEO-optimized repo description suggestion
`GridForge Garage Systems — Laravel 13 + Filament 3 website & ERP for US garage organization (storage racks, cabinets, AI chatbot, knowledge base).`

---

## 🤝 Let's Connect & Collaborate
I am open to Senior Remote Full-Stack Roles, AI Platform Architecture Contracts, and Enterprise Technical Advisory.
Timezone: UTC+6 (Dhaka / Rangpur, Bangladesh) — Flexible overlap with US, UK, and European business hours.
Delivery Mode: Async-ready, Slack, Discord, Jira, GitHub, and production-first accountability.

| Channel | Address / Handle | Quick Action |
|---------|------------------|--------------|
| 🌐 Primary Portfolio | imrandev.bd | Visit Site ↗ |
| 📦 Packagist Packages | packagist.org/packages/imrandevbd/ | View Packages ↗ |
| 💼 LinkedIn Profile | linkedin.com/in/imranbru99 | Connect ↗ |
| 🐙 GitHub Profile | github.com/imranbru99 | Follow ↗ |
| 💬 WhatsApp Direct | +880 1576-918420 | Chat Now ↗ |
| 📧 Direct Email | me@imrandev.bd | Send Email ↗ |
| 🐦 X (Twitter) | @imrandev_bd | Follow ↗ |
| 📺 YouTube Tech | @ImranDevBD | Subscribe ↗ |
