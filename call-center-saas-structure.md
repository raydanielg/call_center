# 📞 CALL CENTER SAAS SYSTEM — LARAVEL (Structure Kamili)

Mfumo wa Call Center wa kulipia (SaaS) — makampuni yanajisajili, yanachagua plan, yanalipa, na yanapata call center yao kamili ndani ya mfumo mmoja.

---

## 1. TEKNOLOJIA (Tech Stack)

| Sehemu | Teknolojia | Kwa nini |
|---|---|---|
| Framework | Laravel 11 | Backend nzima |
| Auth | Laravel Breeze | Login, register, password reset |
| Roles & Permissions | spatie/laravel-permission | Kudhibiti nani anaona nini |
| Multi-tenancy | `tenant_id` kwenye kila table (single database) | Rahisi kuanza nayo, inafaa kwa SaaS ndogo/kati |
| Billing | Laravel Cashier (Stripe) au integration ya M-Pesa/Selcom | Malipo ya subscription |
| Simu (Telephony) | Twilio au Africa's Talking Voice API | Kupiga/kupokea simu, recordings |
| Frontend | Blade + Tailwind CSS + Alpine.js | UI nzuri bila SPA complexity |
| Real-time | Laravel Reverb (WebSockets) | Live monitoring ya agents |
| Queue | Laravel Queue + Redis | SMS, emails, call logs processing |
| Reports/Charts | Chart.js | Dashboard graphs |

---

## 2. ROLES (Watumiaji 5)

### 🟣 1. SUPER ADMIN (Mmiliki wa SaaS — wewe)
Anasimamia mfumo mzima: makampuni yote, plans, malipo.

### 🔵 2. COMPANY ADMIN (Tenant Admin)
Mmiliki wa call center iliyojisajili. Anasimamia kampuni yake tu.

### 🟢 3. SUPERVISOR
Anasimamia agents wa kampuni yake: live monitoring, kugawa kazi, reports.

### 🟡 4. AGENT
Mfanyakazi wa call center: anapokea/anapiga simu, ana-handle tickets.

### 🟠 5. QA ANALYST (Quality Assurance)
Anasikiliza recordings na kutoa alama (score) za ubora wa huduma.

---

## 3. SIDEBAR MENUS ZA KILA ROLE

### 🟣 Super Admin Sidebar
```
📊 Dashboard          → Takwimu za SaaS nzima (revenue, tenants, growth)
🏢 Companies          → Makampuni yote (approve, suspend, delete)
💎 Plans              → Vifurushi (Basic, Pro, Enterprise) — bei na limits
💳 Subscriptions      → Nani amelipa nini, expiry, renewals
💰 Payments           → Historia ya malipo yote
📈 Reports            → Ripoti za mapato na matumizi ya mfumo
⚙️ System Settings    → Mipangilio ya mfumo mzima
👤 Profile
```

### 🔵 Company Admin Sidebar
```
📊 Dashboard          → Takwimu za kampuni (calls leo, agents online, tickets)
👥 Staff              → Kuongeza/kufuta Supervisors, Agents, QA
📞 Calls              → Historia ya simu zote (inbound & outbound)
🎫 Tickets            → Matatizo yote ya wateja
👤 Contacts           → Database ya wateja
📢 Campaigns          → Kampeni za kupiga simu (outbound)
📋 Queues             → Foleni za simu (Sales, Support, n.k.)
📈 Reports            → Performance ya agents, call volume, SLA
💳 Billing            → Plan yao, invoices, ku-upgrade
⚙️ Settings           → Business hours, IVR, greetings, dispositions
👤 Profile
```

### 🟢 Supervisor Sidebar
```
📊 Dashboard          → Muhtasari wa siku (calls, agents online)
🔴 Live Monitor       → Agents wako wapi LIVE (on call, idle, break)
👥 Agents             → Orodha ya agents na performance zao
📞 Calls              → Simu zote za timu yake
🎫 Tickets            → Ku-assign na ku-escalate tickets
📢 Campaigns          → Kusimamia progress ya campaigns
📈 Reports            → Ripoti za timu
👤 Profile
```

### 🟡 Agent Sidebar
```
📊 Dashboard          → Kazi zangu leo (calls, tickets, callbacks)
📞 My Calls           → Simu zangu (kupiga na historia)
🎫 My Tickets         → Tickets nilizopewa
👤 Contacts           → Kutafuta mteja kabla ya kupiga
⏰ Callbacks          → Wateja wa kuwapigia tena (scheduled)
🏆 My Performance     → Score yangu, calls handled, average time
👤 Profile
```

### 🟠 QA Analyst Sidebar
```
📊 Dashboard          → Evaluations pending, average scores
🎧 Recordings         → Kusikiliza recordings za simu
✅ Evaluations        → Kutoa alama kwa kila simu (scorecard)
📈 QA Reports         → Ripoti za ubora kwa kila agent
👤 Profile
```

---

## 4. DATABASE STRUCTURE (Tables Zote)

### A. SaaS Core (Super Admin level)

**1. `plans`** — vifurushi vya kulipia
```
id, name (Basic/Pro/Enterprise), price, billing_cycle (monthly/yearly),
max_agents, max_calls_per_month, max_storage_mb, features (json),
is_active, created_at, updated_at
```

**2. `tenants`** — makampuni yaliyojisajili
```
id, name, slug, email, phone, logo, address, country,
status (active/suspended/pending), trial_ends_at, created_at, updated_at
```

**3. `subscriptions`**
```
id, tenant_id, plan_id, starts_at, ends_at,
status (active/expired/cancelled), created_at, updated_at
```

**4. `payments`**
```
id, tenant_id, subscription_id, amount, currency, payment_method
(mpesa/card/bank), reference_number, status (paid/pending/failed),
paid_at, created_at
```

### B. Users & Roles

**5. `users`**
```
id, tenant_id (nullable — Super Admin hana tenant), name, email, phone,
password, avatar, status (active/inactive),
agent_status (available/on_call/break/offline), extension_number,
last_login_at, created_at, updated_at
```

**6–8. Spatie tables** — `roles`, `permissions`, `model_has_roles`, `model_has_permissions`, `role_has_permissions` (zinajitengeneza zenyewe kwa package)

### C. Call Center Core

**9. `contacts`** — wateja
```
id, tenant_id, name, phone, email, company, address,
tags (json), notes, source (manual/import/campaign),
created_by, created_at, updated_at
```

**10. `queues`** — foleni za simu
```
id, tenant_id, name (Sales/Support), description, strategy
(round_robin/longest_idle), max_wait_time, greeting_audio,
is_active, created_at, updated_at
```

**11. `queue_agent`** — agents wako kwenye queue gani
```
id, queue_id, user_id, priority, created_at
```

**12. `calls`** — kila simu inarekodiwa hapa
```
id, tenant_id, contact_id, agent_id (user_id), queue_id, campaign_id (nullable),
direction (inbound/outbound), phone_number,
status (completed/missed/abandoned/voicemail/busy/failed),
started_at, answered_at, ended_at, duration (seconds), wait_time (seconds),
recording_url, disposition_id, notes,
provider_call_id (Twilio SID), created_at, updated_at
```

**13. `dispositions`** — matokeo ya simu
```
id, tenant_id, name (Interested/Not Interested/Callback/Wrong Number/Sale),
color, is_active, created_at
```

**14. `callbacks`** — wateja wa kuwapigia tena
```
id, tenant_id, contact_id, agent_id, call_id (nullable),
scheduled_at, status (pending/done/missed), notes, created_at, updated_at
```

### D. Tickets (Customer Issues)

**15. `tickets`**
```
id, tenant_id, ticket_number (TKT-0001), contact_id,
assigned_to (user_id), created_by, subject, description,
category, priority (low/medium/high/urgent),
status (open/in_progress/resolved/closed),
sla_due_at, resolved_at, closed_at, created_at, updated_at
```

**16. `ticket_replies`**
```
id, ticket_id, user_id, message, attachment,
is_internal_note (boolean), created_at
```

### E. Campaigns (Outbound)

**17. `campaigns`**
```
id, tenant_id, name, description, type (sales/survey/collection),
script (text — maneno ya kusema), starts_at, ends_at,
status (draft/active/paused/completed), created_by, created_at, updated_at
```

**18. `campaign_contacts`** — orodha ya kupigiwa
```
id, campaign_id, contact_id, assigned_agent_id,
status (pending/called/completed/failed), attempts,
last_called_at, created_at, updated_at
```

### F. Quality Assurance

**19. `evaluations`** — alama za QA
```
id, tenant_id, call_id, agent_id, evaluator_id (QA user),
greeting_score, communication_score, problem_solving_score,
compliance_score, closing_score, total_score, comments,
status (draft/submitted/acknowledged), created_at, updated_at
```

### G. Misc

**20. `agent_sessions`** — muda wa kazi wa agent
```
id, tenant_id, user_id, status (available/on_call/break/offline),
started_at, ended_at, duration, created_at
```

**21. `activity_logs`**
```
id, tenant_id, user_id, action, model_type, model_id,
description, ip_address, created_at
```

**22. `settings`**
```
id, tenant_id (nullable), key, value, created_at, updated_at
```

**23. `notifications`** — Laravel default notifications table

---

## 5. RELATIONSHIPS MUHIMU (ERD kwa maneno)

```
Tenant  ──hasMany──▶ Users, Contacts, Calls, Tickets, Campaigns, Queues
Tenant  ──hasOne───▶ Subscription ──belongsTo──▶ Plan
User    ──hasMany──▶ Calls (as agent), Tickets (assigned), Evaluations
Contact ──hasMany──▶ Calls, Tickets, Callbacks
Call    ──belongsTo─▶ Contact, Agent, Queue, Disposition, Campaign
Call    ──hasOne───▶ Evaluation
Ticket  ──hasMany──▶ TicketReplies
Campaign ─hasMany──▶ CampaignContacts ──belongsTo──▶ Contact
Queue   ──belongsToMany──▶ Users (agents)
```

---

## 6. HATUA ZA KUJENGA (Step by Step)

### 📌 STEP 1: Setup ya Project
```bash
composer create-project laravel/laravel callcenter-saas
cd callcenter-saas
composer require laravel/breeze --dev
php artisan breeze:install blade
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
npm install && npm run build
```

### 📌 STEP 2: Migrations Zote
Tengeneza migrations kwa mpangilio huu (kwa sababu ya foreign keys):
1. `plans` → 2. `tenants` → 3. `subscriptions` → 4. `payments`
5. Ongeza `tenant_id` + fields kwenye `users`
6. `contacts` → 7. `queues` → 8. `queue_agent` → 9. `dispositions`
10. `calls` → 11. `callbacks` → 12. `tickets` → 13. `ticket_replies`
14. `campaigns` → 15. `campaign_contacts` → 16. `evaluations`
17. `agent_sessions` → 18. `activity_logs` → 19. `settings`

### 📌 STEP 3: Roles Seeder
```php
// database/seeders/RoleSeeder.php
$roles = ['super_admin', 'company_admin', 'supervisor', 'agent', 'qa_analyst'];
foreach ($roles as $role) {
    Role::firstOrCreate(['name' => $role]);
}
```

### 📌 STEP 4: Multi-Tenancy (Global Scope)
Tengeneza Trait moja inayochuja data kwa tenant automatically:
```php
// app/Traits/BelongsToTenant.php
trait BelongsToTenant
{
    protected static function bootBelongsToTenant()
    {
        static::addGlobalScope('tenant', function ($query) {
            if (auth()->check() && auth()->user()->tenant_id) {
                $query->where('tenant_id', auth()->user()->tenant_id);
            }
        });

        static::creating(function ($model) {
            if (auth()->check() && auth()->user()->tenant_id) {
                $model->tenant_id = auth()->user()->tenant_id;
            }
        });
    }
}
```
Weka Trait hii kwenye kila Model yenye `tenant_id` (Contact, Call, Ticket, n.k.).
**Hii ndiyo siri ya SaaS yako** — kila kampuni inaona data yake tu, bila wewe kuandika `where('tenant_id', ...)` kila mahali.

### 📌 STEP 5: Middleware za Kulinda Routes
```php
// Mifano ya middleware
'role:super_admin'      → routes za /admin/*
'role:company_admin'    → routes za /company/*
'role:supervisor'       → routes za /supervisor/*
'role:agent'            → routes za /agent/*
'role:qa_analyst'       → routes za /qa/*
CheckSubscription       → kama subscription imeisha, mpeleke billing page
CheckTenantActive       → kama tenant ame-suspendiwa, mzuie
```

### 📌 STEP 6: Routes Structure
```php
// routes/web.php
Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->group(...);
Route::middleware(['auth', 'role:company_admin', 'subscription'])->prefix('company')->group(...);
Route::middleware(['auth', 'role:supervisor'])->prefix('supervisor')->group(...);
Route::middleware(['auth', 'role:agent'])->prefix('agent')->group(...);
Route::middleware(['auth', 'role:qa_analyst'])->prefix('qa')->group(...);
```

### 📌 STEP 7: Sidebar Dynamic (Blade)
```blade
{{-- resources/views/layouts/sidebar.blade.php --}}
@role('super_admin')
    @include('layouts.sidebars.super-admin')
@endrole
@role('company_admin')
    @include('layouts.sidebars.company-admin')
@endrole
@role('supervisor')
    @include('layouts.sidebars.supervisor')
@endrole
@role('agent')
    @include('layouts.sidebars.agent')
@endrole
@role('qa_analyst')
    @include('layouts.sidebars.qa')
@endrole
```
Kila sidebar ni file yake — rahisi ku-maintain na kila mtu anaona menu zake TU.

### 📌 STEP 8: Order ya Kujenga Modules
Jenga kwa mpangilio huu (kutoka rahisi kwenda ngumu):
1. **Auth + Roles + Sidebars** — msingi
2. **Super Admin: Plans + Tenants CRUD** — SaaS core
3. **Tenant Registration flow** — kampuni inajisajili, inachagua plan, inapata trial
4. **Company Admin: Staff management** — kuongeza agents
5. **Contacts CRUD + Import (Excel/CSV)**
6. **Tickets module** — full lifecycle
7. **Calls logging** (manual kwanza, baadaye Twilio)
8. **Campaigns + Callbacks**
9. **QA Evaluations**
10. **Reports + Dashboards** (Chart.js)
11. **Billing** (M-Pesa/Stripe)
12. **Twilio integration** (click-to-call, recordings, IVR)
13. **Live Monitor** (Laravel Reverb WebSockets)

### 📌 STEP 9: Deployment
- VPS (DigitalOcean/Contabo) + Nginx + MySQL + Redis
- SSL (Let's Encrypt)
- `php artisan queue:work` kama supervisor process
- Backups za database kila siku (spatie/laravel-backup)

---

## 7. TIPS ZA KU-FANYA MFUMO UWE POA KABISA 🔥

1. **Ticket numbers za kueleweka** — TKT-2026-0001 badala ya ID tupu
2. **Agent status ya rangi** — 🟢 Available, 🔴 On Call, 🟡 Break, ⚫ Offline
3. **Dashboard cards zenye takwimu za leo** — si za milele, za LEO
4. **Search ya haraka ya contact kwa namba ya simu** — agent akipokea simu aone mteja ni nani papo hapo (screen pop)
5. **SLA timers kwenye tickets** — ticket ikikaribia deadline, ibadilike rangi
6. **Export ya reports kwa Excel/PDF**
7. **Activity log kila kitu** — muhimu kwa accountability
8. **Soft deletes kila mahali** — usifute data moja kwa moja
9. **Limits za plan zifanye kazi** — Basic plan ikiruhusu agents 5, wa 6 asiweze kuongezwa
```php
if ($tenant->users()->role('agent')->count() >= $tenant->plan->max_agents) {
    return back()->with('error', 'Umefika kikomo cha agents. Upgrade plan yako.');
}
```
