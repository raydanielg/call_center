<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\AgentSession;
use App\Models\Callback;
use App\Models\Call;
use App\Models\Campaign;
use App\Models\CampaignContact;
use App\Models\Contact;
use App\Models\Disposition;
use App\Models\Evaluation;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Queue;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\Tenant;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Starting sample data seeding...');

        // ── 1. Super Admin ──
        $superAdmin = User::create([
            'name' => 'System Administrator',
            'first_name' => 'System',
            'last_name' => 'Administrator',
            'email' => 'admin@zerixacc.com',
            'phone' => '+255700000001',
            'password' => 'password',
            'status' => 'active',
            'role' => 'super_admin',
        ]);
        $superAdmin->assignRole('super_admin');
        $this->command->info('  ✓ Super Admin created');

        // ── 2. Tenants (Companies) ──
        $tenantsData = [
            [
                'name' => 'Salaama Telecom',
                'email' => 'info@salaamatelecom.co.tz',
                'phone' => '+255222222201',
                'country' => 'Tanzania',
                'address' => 'Plot 12, Mlimani Tower, Dar es Salaam',
                'plan_name' => 'Enterprise',
                'status' => 'active',
            ],
            [
                'name' => 'Pamoja Microfinance',
                'email' => 'support@pamojamicro.co.tz',
                'phone' => '+255222222202',
                'country' => 'Tanzania',
                'address' => 'Plot 45, Ohio Street, Dar es Salaam',
                'plan_name' => 'Pro',
                'status' => 'active',
            ],
            [
                'name' => 'Bahari Insurance',
                'email' => 'contact@bahariinsurance.co.tz',
                'phone' => '+255222222203',
                'country' => 'Tanzania',
                'address' => 'Plot 78, Ali Hassan Mwinyi Road, Dar es Salaam',
                'plan_name' => 'Basic',
                'status' => 'active',
            ],
            [
                'name' => 'Tausi Retail',
                'email' => 'hello@tausiretail.co.tz',
                'phone' => '+255222222204',
                'country' => 'Tanzania',
                'address' => 'Plot 90, Nyerere Road, Arusha',
                'plan_name' => 'Pro',
                'status' => 'suspended',
            ],
            [
                'name' => 'Simba Logistics',
                'email' => 'info@simbalogistics.co.tz',
                'phone' => '+255222222205',
                'country' => 'Tanzania',
                'address' => 'Plot 33, Nyerere Road, Dar es Salaam',
                'plan_name' => 'Basic',
                'status' => 'active',
            ],
        ];

        $tenants = [];
        foreach ($tenantsData as $data) {
            $plan = Plan::where('name', $data['plan_name'])->first();
            $tenant = Tenant::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'country' => $data['country'],
                'status' => $data['status'],
                'trial_ends_at' => now()->addDays(14),
            ]);
            $tenants[] = $tenant;

            // Subscription
            $sub = Subscription::create([
                'tenant_id' => $tenant->id,
                'plan_id' => $plan->id,
                'starts_at' => now()->subMonths(3),
                'ends_at' => now()->addMonths(9),
                'status' => 'active',
            ]);

            // Payments for each tenant
            for ($i = 1; $i <= 3; $i++) {
                Payment::create([
                    'tenant_id' => $tenant->id,
                    'subscription_id' => $sub->id,
                    'amount' => $plan->price,
                    'currency' => 'TZS',
                    'payment_method' => collect(['mpesa', 'card', 'bank'])->random(),
                    'reference_number' => 'REF-' . strtoupper(Str::random(10)),
                    'status' => 'paid',
                    'paid_at' => now()->subMonths(4 - $i),
                ]);
            }
        }
        $this->command->info('  ✓ 5 Tenants with subscriptions & payments created');

        // ── 3. Users per tenant ──
        $firstNames = ['Amina', 'Juma', 'Fatuma', 'Hassan', 'Neema', 'Omar', 'Zainab', 'Baraka', 'Asha', 'Daudi', 'Halima', 'Saidi', 'Rehema', 'Moshi', 'Tatu'];
        $lastNames = ['Mwangaza', 'Kimaro', 'Hassan', 'Omary', 'Said', 'Mushi', 'Lyimo', 'Nyerere', 'Komba', 'Mwakyusa', 'Shirima', 'Mrema'];

        foreach ($tenants as $index => $tenant) {
            if ($tenant->status === 'suspended') {
                continue;
            }

            // Company Admin
            $admin = User::create([
                'name' => $tenant->name . ' Admin',
                'first_name' => 'Admin',
                'last_name' => $tenant->name,
                'email' => 'admin@' . $tenant->slug . '.com',
                'phone' => '+25571' . str_pad($index + 10, 6, '0', STR_PAD_LEFT),
                'password' => 'password',
                'tenant_id' => $tenant->id,
                'status' => 'active',
                'role' => 'company_admin',
            ]);
            $admin->assignRole('company_admin');

            // Supervisor
            $supervisor = User::create([
                'name' => 'Supervisor ' . $firstNames[$index] . ' ' . $lastNames[$index],
                'first_name' => $firstNames[$index],
                'last_name' => $lastNames[$index],
                'email' => 'supervisor@' . $tenant->slug . '.com',
                'phone' => '+25571' . str_pad($index + 20, 6, '0', STR_PAD_LEFT),
                'password' => 'password',
                'tenant_id' => $tenant->id,
                'status' => 'active',
                'role' => 'supervisor',
            ]);
            $supervisor->assignRole('supervisor');

            // QA Analyst
            $qa = User::create([
                'name' => 'QA ' . $firstNames[($index + 5) % count($firstNames)] . ' ' . $lastNames[($index + 3) % count($lastNames)],
                'first_name' => $firstNames[($index + 5) % count($firstNames)],
                'last_name' => $lastNames[($index + 3) % count($lastNames)],
                'email' => 'qa@' . $tenant->slug . '.com',
                'phone' => '+25571' . str_pad($index + 30, 6, '0', STR_PAD_LEFT),
                'password' => 'password',
                'tenant_id' => $tenant->id,
                'status' => 'active',
                'role' => 'qa_analyst',
            ]);
            $qa->assignRole('qa_analyst');

            // Agents (3-5 per tenant)
            $agentCount = rand(3, 5);
            $agents = [];
            for ($a = 0; $a < $agentCount; $a++) {
                $fn = $firstNames[($index * 3 + $a) % count($firstNames)];
                $ln = $lastNames[($index * 2 + $a) % count($lastNames)];
                $agent = User::create([
                    'name' => $fn . ' ' . $ln,
                    'first_name' => $fn,
                    'last_name' => $ln,
                    'email' => strtolower($fn) . '.' . strtolower($ln) . '@' . $tenant->slug . '.com',
                    'phone' => '+25571' . str_pad($index * 10 + $a + 40, 6, '0', STR_PAD_LEFT),
                    'password' => 'password',
                    'tenant_id' => $tenant->id,
                    'status' => 'active',
                    'agent_status' => collect(['available', 'on_call', 'break', 'offline'])->random(),
                    'extension_number' => '10' . ($index * 10 + $a),
                    'role' => 'agent',
                ]);
                $agent->assignRole('agent');
                $agents[] = $agent;
            }
            $this->command->info("  ✓ Users for {$tenant->name} created (1 admin, 1 supervisor, 1 QA, {$agentCount} agents)");

            // ── 4. Dispositions ──
            $dispositionNames = ['Resolved', 'Follow-up Needed', 'Not Interested', 'Voicemail', 'Wrong Number', 'Transferred', 'Callback Requested'];
            $dispositionColors = ['#10b981', '#f59e0b', '#ef4444', '#6b7280', '#ec4899', '#3b82f6', '#8b5cf6'];
            $dispositions = [];
            foreach ($dispositionNames as $di => $dName) {
                $dispositions[] = Disposition::create([
                    'name' => $dName,
                    'color' => $dispositionColors[$di],
                    'is_active' => true,
                    'tenant_id' => $tenant->id,
                ]);
            }

            // ── 5. Queues ──
            $queues = [];
            $queueNames = ['General Support', 'Sales Inquiries', 'Technical Support', 'Billing Queue'];
            foreach ($queueNames as $qi => $qName) {
                $queue = Queue::create([
                    'name' => $qName,
                    'description' => 'Handles ' . strtolower($qName) . ' for ' . $tenant->name,
                    'strategy' => collect(['round_robin', 'longest_idle'])->random(),
                    'max_wait_time' => 300,
                    'is_active' => true,
                    'tenant_id' => $tenant->id,
                ]);
                // Assign random agents to queue
                $queue->agents()->attach(
                    collect($agents)->random(min(2, count($agents)))->pluck('id')->toArray(),
                    ['priority' => 1]
                );
                $queues[] = $queue;
            }

            // ── 6. Contacts ──
            $contactCompanies = ['Diamond Trust', 'CRDB Bank', 'Vodacom TZ', 'Azam TV', 'Tigo Pesa', 'NMB Bank', 'Selcom', 'Maxcom Africa', 'Jumia TZ', 'KCB Bank'];
            $contacts = [];
            for ($c = 0; $c < 15; $c++) {
                $fn = $firstNames[$c % count($firstNames)];
                $ln = $lastNames[($c + 7) % count($lastNames)];
                $contact = Contact::create([
                    'name' => $fn . ' ' . $ln,
                    'phone' => '+2557' . str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT),
                    'email' => strtolower($fn) . '.' . strtolower($ln) . rand(1, 99) . '@example.com',
                    'company' => $contactCompanies[$c % count($contactCompanies)],
                    'address' => 'Dar es Salaam, Tanzania',
                    'tags' => collect(['customer', 'lead', 'vip', 'prospect'])->random(rand(1, 2))->toArray(),
                    'notes' => 'Sample contact for testing purposes.',
                    'source' => collect(['manual', 'import', 'campaign'])->random(),
                    'created_by' => $admin->id,
                    'tenant_id' => $tenant->id,
                ]);
                $contacts[] = $contact;
            }

            // ── 7. Calls ──
            $callStatuses = ['completed', 'missed', 'completed', 'completed', 'failed', 'completed', 'completed'];
            $directions = ['inbound', 'outbound', 'inbound', 'outbound'];
            $calls = [];
            for ($cl = 0; $cl < 20; $cl++) {
                $agent = $agents[array_rand($agents)];
                $contact = $contacts[array_rand($contacts)];
                $queue = $queues[array_rand($queues)];
                $disposition = $dispositions[array_rand($dispositions)];
                $status = $callStatuses[array_rand($callStatuses)];
                $direction = $directions[array_rand($directions)];
                $duration = $status === 'completed' ? rand(30, 600) : 0;
                $waitTime = $direction === 'inbound' ? rand(0, 120) : 0;
                $startedAt = now()->subDays(rand(0, 30))->subHours(rand(0, 23));

                $call = Call::create([
                    'contact_id' => $contact->id,
                    'agent_id' => $agent->id,
                    'queue_id' => $queue->id,
                    'campaign_id' => null,
                    'direction' => $direction,
                    'phone_number' => $contact->phone,
                    'status' => $status,
                    'started_at' => $startedAt,
                    'answered_at' => $status === 'completed' ? $startedAt->copy()->addSeconds($waitTime) : null,
                    'ended_at' => $status === 'completed' ? $startedAt->copy()->addSeconds($waitTime + $duration) : $startedAt,
                    'duration' => $duration,
                    'wait_time' => $waitTime,
                    'recording_url' => $status === 'completed' && rand(0, 1) ? 'https://example.com/recordings/' . Str::uuid() . '.mp3' : null,
                    'disposition_id' => $status === 'completed' ? $disposition->id : null,
                    'notes' => $status === 'completed' ? collect([
                        'Customer was satisfied with the resolution.',
                        'Caller needed assistance with account setup.',
                        'Discussed product features and pricing.',
                        'Customer reported a technical issue, resolved remotely.',
                        'Follow-up scheduled for next week.',
                    ])->random() : null,
                    'provider_call_id' => 'CALL-' . strtoupper(Str::random(12)),
                    'tenant_id' => $tenant->id,
                ]);
                $calls[] = $call;
            }

            // ── 8. Tickets ──
            $ticketSubjects = [
                'Cannot access account portal',
                'Billing discrepancy on invoice #2024-0892',
                'Request for service upgrade',
                'Poor network connectivity issue',
                'Product delivery delay complaint',
                'Password reset not working',
                'Request for refund - order #4521',
                'SIM card activation problem',
                'Double charge on mobile money payment',
                'General inquiry about new data plans',
            ];
            $ticketPriorities = ['low', 'medium', 'medium', 'high', 'urgent'];
            $ticketStatuses = ['open', 'in_progress', 'resolved', 'closed', 'open'];
            $categories = ['Technical', 'Billing', 'General', 'Sales', 'Complaint'];

            for ($t = 0; $t < 10; $t++) {
                $agent = $agents[array_rand($agents)];
                $contact = $contacts[array_rand($contacts)];
                $priority = $ticketPriorities[array_rand($ticketPriorities)];
                $status = $ticketStatuses[array_rand($ticketStatuses)];
                $createdAt = now()->subDays(rand(0, 20));
                $ticketNumber = 'TKT-' . now()->year . '-' . str_pad($tenant->id . $t + 1, 4, '0', STR_PAD_LEFT);

                $ticket = Ticket::create([
                    'ticket_number' => $ticketNumber,
                    'contact_id' => $contact->id,
                    'assigned_to' => $agent->id,
                    'created_by' => $admin->id,
                    'subject' => $ticketSubjects[$t],
                    'description' => 'Customer ' . $contact->name . ' reported: ' . $ticketSubjects[$t] . '. Please investigate and resolve.',
                    'category' => $categories[array_rand($categories)],
                    'priority' => $priority,
                    'status' => $status,
                    'sla_due_at' => $createdAt->copy()->addHours($priority === 'urgent' ? 4 : ($priority === 'high' ? 8 : 24)),
                    'resolved_at' => in_array($status, ['resolved', 'closed']) ? $createdAt->copy()->addHours(rand(1, 20)) : null,
                    'closed_at' => $status === 'closed' ? $createdAt->copy()->addHours(rand(20, 48)) : null,
                    'tenant_id' => $tenant->id,
                ]);

                // Ticket replies (1-3 per ticket)
                $replyCount = rand(1, 3);
                for ($r = 0; $r < $replyCount; $r++) {
                    TicketReply::create([
                        'ticket_id' => $ticket->id,
                        'user_id' => $r === 0 ? $admin->id : $agent->id,
                        'message' => collect([
                            'Thank you for contacting us. We are looking into this issue.',
                            'I have checked the system and the issue seems to be related to the recent update.',
                            'The issue has been resolved. Please confirm on your end.',
                            'I will escalate this to the technical team for further investigation.',
                            'Customer confirmed the issue is resolved. Ticket can be closed.',
                        ])[$r % 5],
                        'is_internal_note' => $r === 1 && rand(0, 1),
                    ]);
                }
            }

            // ── 9. Campaigns ──
            $campaignTypes = ['sales', 'survey', 'collection'];
            $campaignStatuses = ['draft', 'active', 'paused', 'completed'];
            for ($cmp = 0; $cmp < 3; $cmp++) {
                $cmpType = $campaignTypes[$cmp % 3];
                $cmpStatus = $campaignStatuses[$cmp % 4];
                $campaign = Campaign::create([
                    'name' => ucfirst($cmpType) . ' Campaign ' . ($cmp + 1) . ' - ' . now()->format('M Y'),
                    'description' => 'A ' . $cmpType . ' campaign targeting existing customers for ' . $tenant->name,
                    'type' => $cmpType,
                    'script' => "Hello, my name is [Agent Name] from " . $tenant->name . ". I'm calling regarding your account. Is this a good time to talk?",
                    'starts_at' => now()->subDays(rand(5, 15)),
                    'ends_at' => now()->addDays(rand(5, 20)),
                    'status' => $cmpStatus,
                    'created_by' => $admin->id,
                    'tenant_id' => $tenant->id,
                ]);

                // Add contacts to campaign
                $campaignContacts = collect($contacts)->random(min(5, count($contacts)));
                foreach ($campaignContacts as $cc) {
                    CampaignContact::create([
                        'campaign_id' => $campaign->id,
                        'contact_id' => $cc->id,
                        'assigned_agent_id' => $agents[array_rand($agents)]->id,
                        'status' => collect(['pending', 'called', 'completed'])->random(),
                        'attempts' => rand(0, 3),
                        'last_called_at' => rand(0, 1) ? now()->subDays(rand(0, 5)) : null,
                    ]);
                }
            }

            // ── 10. Callbacks ──
            for ($cb = 0; $cb < 5; $cb++) {
                $contact = $contacts[array_rand($contacts)];
                $agent = $agents[array_rand($agents)];
                Callback::create([
                    'contact_id' => $contact->id,
                    'agent_id' => $agent->id,
                    'call_id' => $calls[array_rand($calls)]->id,
                    'scheduled_at' => collect([now()->addHours(2), now()->addHours(5), now()->addDays(1), now()->subDays(1), now()->addDays(2)])->random(),
                    'status' => collect(['pending', 'pending', 'done', 'missed'])->random(),
                    'notes' => 'Customer requested a callback regarding their account.',
                    'tenant_id' => $tenant->id,
                ]);
            }

            // ── 11. Evaluations ──
            $completedCalls = collect($calls)->filter(fn($c) => $c->status === 'completed');
            foreach ($completedCalls->take(5) as $call) {
                $greeting = rand(12, 20);
                $communication = rand(12, 20);
                $problemSolving = rand(10, 20);
                $compliance = rand(12, 20);
                $closing = rand(10, 20);
                $total = $greeting + $communication + $problemSolving + $compliance + $closing;

                Evaluation::create([
                    'call_id' => $call->id,
                    'agent_id' => $call->agent_id,
                    'evaluator_id' => $qa->id,
                    'greeting_score' => $greeting,
                    'communication_score' => $communication,
                    'problem_solving_score' => $problemSolving,
                    'compliance_score' => $compliance,
                    'closing_score' => $closing,
                    'total_score' => $total,
                    'comments' => collect([
                        'Agent handled the call professionally. Good greeting and closing.',
                        'Communication was clear. Could improve on problem resolution speed.',
                        'Excellent compliance with scripts. Customer was satisfied.',
                        'Good overall performance. Need to work on closing techniques.',
                        'Agent demonstrated good product knowledge and empathy.',
                    ])->random(),
                    'status' => 'submitted',
                    'tenant_id' => $tenant->id,
                ]);
            }

            // ── 12. Agent Sessions ──
            foreach ($agents as $agent) {
                for ($s = 0; $s < 3; $s++) {
                    $started = now()->subDays(rand(0, 10))->subHours(rand(1, 8));
                    $ended = $started->copy()->addHours(rand(4, 9));
                    AgentSession::create([
                        'user_id' => $agent->id,
                        'status' => collect(['available', 'on_call', 'break', 'offline'])->random(),
                        'started_at' => $started,
                        'ended_at' => $ended,
                        'duration' => $started->diffInSeconds($ended),
                        'tenant_id' => $tenant->id,
                    ]);
                }
            }

            // ── 13. Settings ──
            Setting::set('company_name', $tenant->name, $tenant->id);
            Setting::set('timezone', 'Africa/Dar_es_Salaam', $tenant->id);
            Setting::set('default_sla_hours', '24', $tenant->id);
            Setting::set('currency', 'TZS', $tenant->id);

            // ── 14. Activity Logs ──
            $allUsers = array_merge([$admin, $supervisor, $qa], $agents);
            for ($al = 0; $al < 10; $al++) {
                $user = $allUsers[array_rand($allUsers)];
                ActivityLog::create([
                    'user_id' => $user->id,
                    'action' => collect(['login', 'created_call', 'updated_ticket', 'created_contact', 'viewed_report', 'logout'])->random(),
                    'model_type' => collect(['Call', 'Ticket', 'Contact', 'User'])->random(),
                    'model_id' => rand(1, 20),
                    'description' => 'User ' . $user->name . ' performed an action.',
                    'ip_address' => '192.168.1.' . rand(1, 255),
                    'tenant_id' => $tenant->id,
                ]);
            }
        }

        $this->command->info('  ✓ Sample data seeding completed!');
        $this->command->info('');
        $this->command->info('=== LOGIN CREDENTIALS ===');
        $this->command->info('Super Admin:  admin@zerixacc.com / password');
        $this->command->info('');
        $this->command->info('Tenant Users (pattern: role@tenant-slug.com / password)');
        $this->command->info('  Salaama Telecom:');
        $this->command->info('    admin@salaama-telecom.com / password');
        $this->command->info('    supervisor@salaama-telecom.com / password');
        $this->command->info('    qa@salaama-telecom.com / password');
        $this->command->info('    amina.mwangaza@salaama-telecom.com / password (agent)');
        $this->command->info('  Pamoja Microfinance:');
        $this->command->info('    admin@pamoja-microfinance.com / password');
        $this->command->info('    supervisor@pamoja-microfinance.com / password');
        $this->command->info('    qa@pamoja-microfinance.com / password');
    }
}
