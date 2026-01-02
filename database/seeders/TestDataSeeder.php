<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Keynote;
use App\Models\News;
use App\Models\Faq;
use App\Models\ImportantDate;
use App\Models\Call;
use App\Models\Author;
use App\Models\Organization;
use App\Models\Conference;
use Carbon\Carbon;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create pages with rich content
        $homePage = Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'HomePage',
                'component' => 'HomePage',
                'content' => '<p>Welcome to MMM 2027!</p>',
                'json' => [
                    'sections' => [
                        [
                            'id' => 'text-1',
                            'type' => 'text',
                            'data' => [
                                'html' => '<div style="text-align: center; margin: 40px 0;"><h1 style="color: #2A0845; font-size: 3em; margin-bottom: 20px;">Welcome to MMM 2027</h1><p style="font-size: 1.3em; color: #555; line-height: 1.8;">The 33rd International Conference on Multimedia Modeling</p><p style="font-size: 1.1em; color: #777; margin-top: 15px;">June 15-17, 2025 | University of Technology</p></div><div style="margin: 40px 0;"><img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1200&h=600&fit=crop" alt="Conference Venue" style="width: 100%; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);"/></div><div style="max-width: 900px; margin: 0 auto; padding: 30px;"><h2 style="color: #2A0845; margin-bottom: 20px;">About the Conference</h2><p style="font-size: 1.1em; line-height: 1.8; color: #333; margin-bottom: 20px;">Multimedia Modelling 2027 (MMM 2027) is a premier international conference that brings together researchers, practitioners, and industry leaders from around the world to share the latest advances in multimedia modeling, analysis, and applications.</p><p style="font-size: 1.1em; line-height: 1.8; color: #333; margin-bottom: 20px;">Join us for an exciting program featuring:</p><ul style="font-size: 1.1em; line-height: 2; color: #333;"><li>🎤 Keynote presentations by renowned experts</li><li>📊 Technical sessions with cutting-edge research</li><li>🔬 Workshops on emerging topics</li><li>🤝 Networking opportunities with peers</li><li>🏆 Best paper awards and recognition</li></ul></div>'
                            ]
                        ]
                    ]
                ]
            ]
        );

        $conferencePage = Page::updateOrCreate(
            ['slug' => 'conference'],
            [
                'title' => 'Conference',
                'component' => 'Conference',
                'content' => '<p>Conference Information</p>',
                'json' => [
                    'sections' => [
                        [
                            'id' => 'text-1',
                            'type' => 'text',
                            'data' => [
                                'html' => '<div style="max-width: 1000px; margin: 0 auto; padding: 20px;"><h1 style="color: #2A0845; text-align: center; margin-bottom: 30px;">About MMM 2027</h1><div style="margin: 30px 0;"><img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=1000&h=500&fit=crop" alt="Conference" style="width: 100%; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"/></div><p style="font-size: 1.2em; line-height: 1.9; color: #333; margin-bottom: 25px;">The 33rd International Conference on Multimedia Modeling (MMM 2027) brings together researchers and practitioners from academia and industry to share the latest advances in multimedia modeling, analysis, and applications.</p><h2 style="color: #2A0845; margin-top: 40px; margin-bottom: 20px;">Conference Highlights</h2><div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin: 30px 0;"><div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #2A0845;"><h3 style="color: #2A0845; margin-bottom: 10px;">📅 Dates</h3><p style="color: #555;">June 15-17, 2025</p></div><div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #2A0845;"><h3 style="color: #2A0845; margin-bottom: 10px;">📍 Venue</h3><p style="color: #555;">University of Technology</p></div><div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #2A0845;"><h3 style="color: #2A0845; margin-bottom: 10px;">🌍 Location</h3><p style="color: #555;">City, Country</p></div></div><h2 style="color: #2A0845; margin-top: 40px; margin-bottom: 20px;">Conference Venue</h2><div style="margin: 30px 0;"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.184132576687!2d-73.98811768459418!3d40.75889597932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes%20Square!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus" width="100%" height="450" style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div><h2 style="color: #2A0845; margin-top: 40px; margin-bottom: 20px;">Watch Our Promotional Video</h2><div style="margin: 30px 0; text-align: center;"><iframe width="100%" height="500" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="MMM 2027 Conference" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 8px; max-width: 900px;"></iframe></div></div>'
                            ]
                        ]
                    ]
                ]
            ]
        );

        $attendingPage = Page::updateOrCreate(
            ['slug' => 'attending'],
            [
                'title' => 'Attending',
                'component' => 'Attending',
                'content' => '<p>Attending Information</p>',
                'json' => [
                    'sections' => [
                        [
                            'id' => 'text-1',
                            'type' => 'text',
                            'data' => [
                                'html' => '<div style="max-width: 1000px; margin: 0 auto; padding: 20px;"><h1 style="color: #2A0845; text-align: center; margin-bottom: 30px;">Attending MMM 2027</h1><div style="margin: 30px 0;"><img src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=1000&h=500&fit=crop" alt="Conference Attendees" style="width: 100%; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"/></div><p style="font-size: 1.2em; line-height: 1.9; color: #333; margin-bottom: 30px; text-align: center;">We look forward to welcoming you to MMM 2027! This page contains important information for conference attendees.</p><div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin: 40px 0;"><div style="background: #fff; border: 2px solid #2A0845; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><h2 style="color: #2A0845; margin-bottom: 15px; font-size: 1.8em;">📝 Registration</h2><p style="font-size: 1.1em; line-height: 1.8; margin-bottom: 15px; color: #333;">Registration is now open! Secure your spot early.</p><p style="font-size: 1em; color: #555;"><strong>Early Bird Deadline:</strong> March 1st, 2025</p><p style="font-size: 1em; color: #555;"><strong>Discount:</strong> 20% off regular price</p></div><div style="background: #fff; border: 2px solid #2A0845; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><h2 style="color: #2A0845; margin-bottom: 15px; font-size: 1.8em;">🏨 Accommodation</h2><p style="font-size: 1.1em; line-height: 1.8; margin-bottom: 15px; color: #333;">Special rates available at partner hotels.</p><p style="font-size: 1em; color: #555;">Book early for best rates and availability.</p></div><div style="background: #fff; border: 2px solid #2A0845; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><h2 style="color: #2A0845; margin-bottom: 15px; font-size: 1.8em;">✈️ Travel</h2><p style="font-size: 1.1em; line-height: 1.8; margin-bottom: 15px; color: #333;">Easy access from major airports.</p><p style="font-size: 1em; color: #555;">Public transportation available.</p></div></div><h2 style="color: #2A0845; margin-top: 50px; margin-bottom: 20px;">Conference Venue Location</h2><div style="margin: 30px 0;"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.184132576687!2d-73.98811768459418!3d40.75889597932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes%20Square!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus" width="100%" height="450" style="border:0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div><h2 style="color: #2A0845; margin-top: 50px; margin-bottom: 20px;">What to Expect</h2><div style="background: #f8f9fa; padding: 30px; border-radius: 8px; margin: 30px 0;"><ul style="font-size: 1.1em; line-height: 2.2; color: #333;"><li>🎓 Access to all technical sessions and workshops</li><li>☕ Coffee breaks and networking sessions</li><li>🍽️ Welcome reception and conference dinner</li><li>📚 Conference proceedings and materials</li><li>🎁 Conference bag with goodies</li><li>💼 Professional networking opportunities</li></ul></div></div>'
                            ]
                        ]
                    ]
                ]
            ]
        );

        $callsPage = Page::updateOrCreate(
            ['slug' => 'calls'],
            [
                'title' => 'Calls',
                'component' => 'Calls',
                'content' => '<p>Call for Submissions</p>',
                'json' => [
                    'sections' => [
                        [
                            'id' => 'text-1',
                            'type' => 'text',
                            'data' => [
                                'html' => '<div style="max-width: 1000px; margin: 0 auto; padding: 20px;"><h1 style="color: #2A0845; text-align: center; margin-bottom: 30px;">Call for Submissions</h1><div style="margin: 30px 0; text-align: center;"><img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1000&h=400&fit=crop" alt="Research" style="width: 100%; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"/></div><p style="font-size: 1.2em; line-height: 1.9; color: #333; margin-bottom: 30px; text-align: center;">MMM 2027 invites submissions of original research papers, workshop proposals, and demonstration proposals. Join us in advancing the field of multimedia modeling!</p><div style="background: #2A0845; padding: 40px; border-radius: 8px; color: white; margin: 40px 0; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><h2 style="font-size: 2em; margin-bottom: 20px; text-align: center;">📅 Important Dates</h2><div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 30px;"><div style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 8px; text-align: center; border: 1px solid rgba(255,255,255,0.2);"><p style="font-size: 1.1em; font-weight: bold; margin-bottom: 10px;">Paper Submission</p><p style="font-size: 1.3em;">February 15, 2025</p></div><div style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 8px; text-align: center; border: 1px solid rgba(255,255,255,0.2);"><p style="font-size: 1.1em; font-weight: bold; margin-bottom: 10px;">Notification</p><p style="font-size: 1.3em;">April 15, 2025</p></div><div style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 8px; text-align: center; border: 1px solid rgba(255,255,255,0.2);"><p style="font-size: 1.1em; font-weight: bold; margin-bottom: 10px;">Camera Ready</p><p style="font-size: 1.3em;">May 15, 2025</p></div></div></div></div>'
                            ]
                        ]
                    ]
                ]
            ]
        );

        $authorsPage = Page::updateOrCreate(
            ['slug' => 'authors'],
            [
                'title' => 'Authors',
                'component' => 'Authors',
                'content' => '<p>Author Information</p>',
                'json' => [
                    'sections' => [
                        [
                            'id' => 'text-1',
                            'type' => 'text',
                            'data' => [
                                'html' => '<div style="max-width: 1000px; margin: 0 auto; padding: 20px;"><h1 style="color: #2A0845; text-align: center; margin-bottom: 30px;">Information for Authors</h1><div style="margin: 30px 0;"><img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1000&h=500&fit=crop" alt="Authors" style="width: 100%; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"/></div><p style="font-size: 1.2em; line-height: 1.9; color: #333; margin-bottom: 30px;">This page contains important guidelines and information for authors submitting papers to MMM 2027. Please read carefully to ensure your submission meets all requirements.</p><div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; margin: 40px 0;"><div style="background: #fff; border: 2px solid #2A0845; padding: 25px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"><h3 style="color: #2A0845; margin-bottom: 15px; font-size: 1.5em;">📄 Paper Format</h3><ul style="line-height: 2; color: #555;"><li>ACM template required</li><li>Maximum 8 pages</li><li>PDF format only</li><li>English language</li></ul></div><div style="background: #fff; border: 2px solid #2A0845; padding: 25px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"><h3 style="color: #2A0845; margin-bottom: 15px; font-size: 1.5em;">📤 Submission</h3><ul style="line-height: 2; color: #555;"><li>Online submission system</li><li>Double-blind review</li><li>Original work only</li><li>No simultaneous submission</li></ul></div><div style="background: #fff; border: 2px solid #2A0845; padding: 25px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"><h3 style="color: #2A0845; margin-bottom: 15px; font-size: 1.5em;">✅ Review Process</h3><ul style="line-height: 2; color: #555;"><li>Peer review</li><li>Expert reviewers</li><li>Constructive feedback</li><li>Fair evaluation</li></ul></div></div><h2 style="color: #2A0845; margin-top: 50px; margin-bottom: 20px;">Submission Guidelines Video</h2><div style="margin: 30px 0; text-align: center;"><iframe width="100%" height="500" src="https://www.youtube.com/embed/jNQXAC9IVRw" title="Submission Guidelines" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 10px; max-width: 900px;"></iframe></div></div>'
                            ]
                        ]
                    ]
                ]
            ]
        );

        $registerPage = Page::updateOrCreate(
            ['slug' => 'register'],
            [
                'title' => 'Register',
                'component' => 'Register',
                'content' => '<p>Registration Information</p>',
                'json' => [
                    'sections' => [
                        [
                            'id' => 'text-1',
                            'type' => 'text',
                            'data' => [
                                'html' => '<div style="max-width: 1000px; margin: 0 auto; padding: 20px;"><h1 style="color: #2A0845; text-align: center; margin-bottom: 30px;">Registration</h1><div style="margin: 30px 0; text-align: center;"><img src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=1000&h=400&fit=crop" alt="Registration" style="width: 100%; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"/></div><p style="font-size: 1.3em; line-height: 1.9; color: #333; margin-bottom: 40px; text-align: center; font-weight: 500;">Register now to secure your spot at MMM 2027. Early bird registration offers significant discounts!</p><div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px; margin: 40px 0;"><div style="background: #fff; border: 3px solid #2A0845; padding: 30px; border-radius: 8px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><h2 style="color: #2A0845; font-size: 2em; margin-bottom: 15px;">Early Bird</h2><p style="font-size: 3em; font-weight: bold; margin: 20px 0; color: #2A0845;">$450</p><p style="font-size: 1.1em; color: #555;">Until March 1, 2025</p><p style="font-size: 0.9em; margin-top: 15px; color: #777;">Save 20%</p></div><div style="background: #fff; border: 3px solid #666; padding: 30px; border-radius: 8px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><h2 style="color: #333; font-size: 2em; margin-bottom: 15px;">Regular</h2><p style="font-size: 3em; font-weight: bold; margin: 20px 0; color: #333;">$550</p><p style="font-size: 1.1em; color: #555;">After March 1, 2025</p><p style="font-size: 0.9em; margin-top: 15px; color: #777;">Standard rate</p></div><div style="background: #fff; border: 3px solid #2A0845; padding: 30px; border-radius: 8px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><h2 style="color: #2A0845; font-size: 2em; margin-bottom: 15px;">Student</h2><p style="font-size: 3em; font-weight: bold; margin: 20px 0; color: #2A0845;">$300</p><p style="font-size: 1.1em; color: #555;">Valid ID required</p><p style="font-size: 0.9em; margin-top: 15px; color: #777;">45% discount</p></div></div><div style="background: #f8f9fa; padding: 30px; border-radius: 8px; margin: 40px 0;"><h2 style="color: #2A0845; margin-bottom: 20px;">What\'s Included</h2><div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;"><p style="color: #555; font-size: 1.1em;">✅ All technical sessions</p><p style="color: #555; font-size: 1.1em;">✅ Workshop access</p><p style="color: #555; font-size: 1.1em;">✅ Conference materials</p><p style="color: #555; font-size: 1.1em;">✅ Coffee breaks</p><p style="color: #555; font-size: 1.1em;">✅ Welcome reception</p><p style="color: #555; font-size: 1.1em;">✅ Conference dinner</p></div></div></div>'
                            ]
                        ]
                    ]
                ]
            ]
        );

        // Create Keynotes with rich content, dates, and times
        $keynote1 = Keynote::firstOrNew([
            'page_id' => $conferencePage->id,
            'name' => 'Dr. Jane Smith'
        ]);
        if (!$keynote1->exists) {
            $keynote1->fill([
                'date' => '2025-06-15',
                'time' => '09:00',
                'title' => 'Keynote: The Future of Multimedia AI - Professor of Computer Science, University of Technology',
                'photo_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=400&fit=crop',
                'bio_html' => '<div style="padding: 15px;"><p style="font-size: 1.1em; line-height: 1.8; color: #333; margin-bottom: 15px;"><strong>Dr. Jane Smith</strong> is a renowned researcher and professor in the field of computer science, specializing in multimedia analysis and artificial intelligence.</p><p style="font-size: 1em; line-height: 1.8; color: #555;">With over 15 years of experience, she has published more than 80 papers in top-tier conferences and journals. Her research focuses on deep learning applications in multimedia content understanding, video analysis, and cross-modal retrieval systems.</p><p style="font-size: 1em; line-height: 1.8; color: #555;">Dr. Smith has received numerous awards including the Best Paper Award at ACM MM 2020 and the Young Researcher Award from IEEE in 2018.</p></div>',
                'body_html' => '<div style="padding: 15px;"><h3 style="color: #2A0845; margin-bottom: 15px;">Keynote Abstract</h3><p style="font-size: 1.1em; line-height: 1.9; color: #333; margin-bottom: 20px;">Join us for an exciting keynote presentation on <strong>"The Future of Multimedia AI: Challenges and Opportunities"</strong> where Dr. Smith will explore the latest advances in artificial intelligence for multimedia applications.</p><p style="font-size: 1em; line-height: 1.9; color: #555; margin-bottom: 15px;">This talk will cover:</p><ul style="font-size: 1em; line-height: 2; color: #555;"><li>Recent breakthroughs in multimedia AI</li><li>Challenges in large-scale multimedia systems</li><li>Future research directions</li><li>Industry applications and impact</li></ul><div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 20px;"><p style="font-size: 1em; color: #555; margin: 0;"><strong>📅 Date:</strong> June 15, 2025</p><p style="font-size: 1em; color: #555; margin: 5px 0;"><strong>⏰ Time:</strong> 9:00 AM - 10:30 AM</p><p style="font-size: 1em; color: #555; margin: 0;"><strong>📍 Location:</strong> Main Auditorium</p></div></div>'
            ]);
            $keynote1->save();
        }

        $keynote2 = Keynote::firstOrNew([
            'page_id' => $conferencePage->id,
            'name' => 'Prof. John Doe'
        ]);
        if (!$keynote2->exists) {
            $keynote2->fill([
                'date' => '2025-06-16',
                'time' => '14:30',
                'title' => 'Keynote: Deep Learning in Multimedia - Distinguished Professor, Global Research Institute',
                'photo_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop',
                'bio_html' => '<div style="padding: 15px;"><p style="font-size: 1.1em; line-height: 1.8; color: #333; margin-bottom: 15px;"><strong>Prof. John Doe</strong> is a distinguished professor and leading expert in artificial intelligence and machine learning, with a particular focus on multimedia applications.</p><p style="font-size: 1em; line-height: 1.8; color: #555;">He has published over 150 papers in top-tier conferences and journals, including CVPR, ICCV, ACM MM, and IEEE Transactions. His research has been cited more than 10,000 times.</p><p style="font-size: 1em; line-height: 1.8; color: #555;">Prof. Doe has served as program chair for several major conferences and is a fellow of both ACM and IEEE. He has also co-founded two successful AI startups.</p></div>',
                'body_html' => '<div style="padding: 15px;"><h3 style="color: #2A0845; margin-bottom: 15px;">Keynote Abstract</h3><p style="font-size: 1.1em; line-height: 1.9; color: #333; margin-bottom: 20px;">In this keynote, Prof. Doe will present <strong>"Deep Learning in Multimedia: From Theory to Practice"</strong>, exploring the latest trends in artificial intelligence and machine learning for multimedia systems.</p><p style="font-size: 1em; line-height: 1.9; color: #555; margin-bottom: 15px;">The presentation will discuss:</p><ul style="font-size: 1em; line-height: 2; color: #555;"><li>State-of-the-art deep learning architectures</li><li>Multimodal learning approaches</li><li>Real-world applications and case studies</li><li>Future research challenges</li></ul><div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 20px;"><p style="font-size: 1em; color: #555; margin: 0;"><strong>📅 Date:</strong> June 16, 2025</p><p style="font-size: 1em; color: #555; margin: 5px 0;"><strong>⏰ Time:</strong> 2:30 PM - 4:00 PM</p><p style="font-size: 1em; color: #555; margin: 0;"><strong>📍 Location:</strong> Main Auditorium</p></div></div>'
            ]);
            $keynote2->save();
        }

        $keynote3 = Keynote::firstOrNew([
            'page_id' => $conferencePage->id,
            'name' => 'Dr. Sarah Johnson'
        ]);
        if (!$keynote3->exists) {
            $keynote3->fill([
                'date' => '2025-06-17',
                'time' => '10:00',
                'title' => 'Keynote: Multimedia in the Age of Big Data - Senior Research Scientist, Tech Innovations Lab',
                'photo_url' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop',
                'bio_html' => '<div style="padding: 15px;"><p style="font-size: 1.1em; line-height: 1.8; color: #333; margin-bottom: 15px;"><strong>Dr. Sarah Johnson</strong> is a senior research scientist specializing in large-scale multimedia systems and big data analytics.</p><p style="font-size: 1em; line-height: 1.8; color: #555;">With expertise in distributed systems and cloud computing, she has led several industry projects processing petabytes of multimedia data. Her work has been instrumental in developing scalable solutions for multimedia content delivery and analysis.</p><p style="font-size: 1em; line-height: 1.8; color: #555;">Dr. Johnson holds a Ph.D. in Computer Science and has received the Innovation Award from the Multimedia Systems Association.</p></div>',
                'body_html' => '<div style="padding: 15px;"><h3 style="color: #2A0845; margin-bottom: 15px;">Keynote Abstract</h3><p style="font-size: 1.1em; line-height: 1.9; color: #333; margin-bottom: 20px;">Dr. Johnson will present <strong>"Multimedia in the Age of Big Data: Scalability and Efficiency"</strong>, focusing on how modern systems handle massive multimedia datasets.</p><p style="font-size: 1em; line-height: 1.9; color: #555; margin-bottom: 15px;">Key topics include:</p><ul style="font-size: 1em; line-height: 2; color: #555;"><li>Scalable multimedia processing architectures</li><li>Cloud-based multimedia systems</li><li>Efficient storage and retrieval strategies</li><li>Real-world deployment experiences</li></ul><div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 20px;"><p style="font-size: 1em; color: #555; margin: 0;"><strong>📅 Date:</strong> June 17, 2025</p><p style="font-size: 1em; color: #555; margin: 5px 0;"><strong>⏰ Time:</strong> 10:00 AM - 11:30 AM</p><p style="font-size: 1em; color: #555; margin: 0;"><strong>📍 Location:</strong> Main Auditorium</p></div></div>'
            ]);
            $keynote3->save();
        }

        // Create News items with rich content
        News::firstOrCreate(
            [
                'page_id' => $homePage->id,
                'title' => 'Conference Registration Now Open'
            ],
            [
                'content' => '<div style="padding: 20px;"><div style="text-align: center; margin-bottom: 20px;"><img src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=600&h=300&fit=crop" alt="Registration" style="width: 100%; max-width: 600px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"/></div><p style="font-size: 1.2em; line-height: 1.9; color: #333; margin-bottom: 20px;">🎉 <strong>Early bird registration is now available!</strong> Register before March 1st, 2025 to get a <strong style="color: #2A0845;">20% discount</strong> on conference registration.</p><p style="font-size: 1.1em; line-height: 1.9; color: #555;">Take advantage of this special offer and secure your spot at MMM 2027. Early bird registration includes access to all sessions, workshops, conference materials, and social events.</p></div>',
                'link_text' => 'Register Now',
                'link_url' => '/register',
                'published_at' => Carbon::now()->subDays(5)
            ]
        );

        News::firstOrCreate(
            [
                'page_id' => $homePage->id,
                'title' => 'Call for Papers Extended'
            ],
            [
                'content' => '<div style="padding: 20px;"><div style="text-align: center; margin-bottom: 20px;"><img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600&h=300&fit=crop" alt="Call for Papers" style="width: 100%; max-width: 600px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"/></div><p style="font-size: 1.2em; line-height: 1.9; color: #333; margin-bottom: 20px;">📢 <strong>Great news!</strong> The submission deadline has been <strong style="color: #2A0845;">extended to February 15th, 2025</strong>.</p><p style="font-size: 1.1em; line-height: 1.9; color: #555; margin-bottom: 15px;">This extension gives you more time to prepare and submit your research papers. We encourage all researchers to take advantage of this opportunity to share their innovative work at MMM 2027.</p><p style="font-size: 1.1em; line-height: 1.9; color: #555;"><strong>New Deadline:</strong> February 15, 2025 (23:59 AOE)</p></div>',
                'link_text' => 'Submit Paper',
                'link_url' => '/calls',
                'published_at' => Carbon::now()->subDays(2)
            ]
        );

        News::firstOrCreate(
            [
                'page_id' => $homePage->id,
                'title' => 'Keynote Speakers Announced'
            ],
            [
                'content' => '<div style="padding: 20px;"><div style="text-align: center; margin-bottom: 20px;"><img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=600&h=300&fit=crop" alt="Keynote Speakers" style="width: 100%; max-width: 600px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"/></div><p style="font-size: 1.2em; line-height: 1.9; color: #333; margin-bottom: 20px;">🎤 We are excited to announce our distinguished keynote speakers for MMM 2027!</p><p style="font-size: 1.1em; line-height: 1.9; color: #555;">Join us for inspiring presentations from leading experts in multimedia modeling, artificial intelligence, and computer vision. Our keynote speakers will share their insights on the latest trends and future directions in the field.</p></div>',
                'link_text' => 'View Keynotes',
                'link_url' => '/conference',
                'published_at' => Carbon::now()->subDays(10)
            ]
        );

        // Create FAQs with detailed answers
        Faq::firstOrCreate(
            ['question' => 'When is the conference?'],
            [
                'answer' => 'The conference will be held from June 15-17, 2025 at the University of Technology. The program includes three full days of technical sessions, workshops, keynotes, and networking events.',
                'order' => 1
            ]
        );

        Faq::firstOrCreate(
            ['question' => 'How do I register?'],
            [
                'answer' => 'You can register online through our registration page. Simply click on the "Register Now" button, fill out the registration form, and complete the payment. Early bird discounts (20% off) are available until March 1st, 2025. Student discounts are also available with valid student ID.',
                'order' => 2
            ]
        );

        Faq::firstOrCreate(
            ['question' => 'What is included in the registration fee?'],
            [
                'answer' => 'Registration includes access to all technical sessions, workshops, keynote presentations, conference proceedings (digital), conference bag with materials, coffee breaks, welcome reception, and conference dinner. Accommodation and travel are not included.',
                'order' => 3
            ]
        );

        Faq::firstOrCreate(
            ['question' => 'Where is the conference venue located?'],
            [
                'answer' => 'The conference will be held at the University of Technology, located at 123 Main Street, City, Country. The venue is easily accessible by public transportation and is located in the heart of the city. Detailed directions and a map are available on the Attending page.',
                'order' => 4
            ]
        );

        Faq::firstOrCreate(
            ['question' => 'What are the submission deadlines?'],
            [
                'answer' => 'Paper submission deadline: February 15, 2025 (23:59 AOE). Notification of acceptance: April 15, 2025. Camera-ready submission: May 15, 2025. Workshop and demo proposals have different deadlines - please check the Calls page for details.',
                'order' => 5
            ]
        );

        Faq::firstOrCreate(
            ['question' => 'Is there a student discount?'],
            [
                'answer' => 'Yes! Students can register at a discounted rate of $300 (45% off regular price). A valid student ID must be presented at registration. Student registration includes all the same benefits as regular registration.',
                'order' => 6
            ]
        );

        // Create Important Dates
        ImportantDate::firstOrCreate(
            ['due_date' => '2025-02-15'],
            ['description' => 'Paper Submission Deadline']
        );

        ImportantDate::firstOrCreate(
            ['due_date' => '2025-03-01'],
            ['description' => 'Early Bird Registration Deadline']
        );

        ImportantDate::firstOrCreate(
            ['due_date' => '2025-04-15'],
            ['description' => 'Notification of Acceptance']
        );

        ImportantDate::firstOrCreate(
            ['due_date' => '2025-05-15'],
            ['description' => 'Camera Ready Submission']
        );

        ImportantDate::firstOrCreate(
            ['due_date' => '2025-06-15'],
            ['description' => 'Conference Start Date']
        );

        ImportantDate::firstOrCreate(
            ['due_date' => '2025-06-17'],
            ['description' => 'Conference End Date']
        );

        // Create Calls for Calls page with rich content
        Call::firstOrCreate(
            [
                'page_id' => $callsPage->id,
                'type' => 'paper'
            ],
            [
                'title' => 'Call for Papers',
                'content' => '<div style="max-width: 900px; margin: 0 auto; padding: 20px;"><div style="text-align: center; margin-bottom: 30px;"><img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&h=400&fit=crop" alt="Research Papers" style="width: 100%; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"/></div><h2 style="color: #2A0845; margin-bottom: 20px;">Call for Research Papers</h2><p style="font-size: 1.1em; line-height: 1.9; color: #333; margin-bottom: 25px;">We invite researchers and practitioners to submit original research papers on multimedia modeling, analysis, and applications. MMM 2027 provides a premier forum for presenting and discussing the latest advances in multimedia research.</p><h3 style="color: #2A0845; margin-top: 30px; margin-bottom: 15px;">Topics of Interest</h3><div style="background: #f8f9fa; padding: 25px; border-radius: 10px; margin: 20px 0;"><ul style="font-size: 1.1em; line-height: 2.2; color: #333;"><li>🎯 Multimedia content analysis and understanding</li><li>🔍 Multimedia retrieval and search</li><li>💻 Multimedia systems and applications</li><li>🤖 Deep learning for multimedia</li><li>📊 Multimedia data mining</li><li>🎨 Multimedia visualization</li><li>🌐 Social multimedia</li><li>📱 Mobile multimedia</li></ul></div><h3 style="color: #2A0845; margin-top: 30px; margin-bottom: 15px;">Submission Guidelines</h3><div style="background: #fff; border-left: 4px solid #2A0845; padding: 20px; margin: 20px 0; border-radius: 5px;"><p style="font-size: 1.1em; line-height: 1.9; color: #333; margin-bottom: 10px;"><strong>Format:</strong> Papers should be submitted in PDF format following the ACM template (available on our website).</p><p style="font-size: 1.1em; line-height: 1.9; color: #333; margin-bottom: 10px;"><strong>Length:</strong> Maximum 8 pages including references.</p><p style="font-size: 1.1em; line-height: 1.9; color: #333; margin-bottom: 10px;"><strong>Language:</strong> All papers must be written in English.</p><p style="font-size: 1.1em; line-height: 1.9; color: #333;"><strong>Review:</strong> All submissions will undergo a double-blind peer review process.</p></div><div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 25px; border-radius: 10px; color: white; margin: 30px 0; text-align: center;"><p style="font-size: 1.3em; font-weight: bold; margin-bottom: 10px;">📅 Submission Deadline</p><p style="font-size: 2em; font-weight: bold;">February 15, 2025</p><p style="font-size: 1em; margin-top: 10px; opacity: 0.9;">23:59 Anywhere on Earth (AOE)</p></div></div>'
            ]
        );

        Call::firstOrCreate(
            [
                'page_id' => $callsPage->id,
                'type' => 'workshop'
            ],
            [
                'title' => 'Call for Workshop Proposals',
                'content' => '<div style="max-width: 900px; margin: 0 auto; padding: 20px;"><div style="text-align: center; margin-bottom: 30px;"><img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&h=400&fit=crop" alt="Workshops" style="width: 100%; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"/></div><h2 style="color: #2A0845; margin-bottom: 20px;">Call for Workshop Proposals</h2><p style="font-size: 1.1em; line-height: 1.9; color: #333; margin-bottom: 25px;">We welcome proposals for workshops to be held in conjunction with MMM 2027. Workshops provide an excellent opportunity for researchers to explore emerging topics, share ideas, and foster collaboration in specialized areas of multimedia modeling.</p><h3 style="color: #2A0845; margin-top: 30px; margin-bottom: 15px;">Workshop Proposal Requirements</h3><div style="background: #f8f9fa; padding: 25px; border-radius: 10px; margin: 20px 0;"><ul style="font-size: 1.1em; line-height: 2.2; color: #333;"><li>📝 Workshop title and detailed scope</li><li>👥 Organizers and their affiliations</li><li>👤 Program committee members</li><li>📊 Expected number of participants</li><li>⏰ Proposed format and schedule</li><li>📋 Call for papers (if applicable)</li><li>📅 Important dates and deadlines</li></ul></div><h3 style="color: #2A0845; margin-top: 30px; margin-bottom: 15px;">Workshop Benefits</h3><div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 30px 0;"><div style="background: #fff; border: 2px solid #2A0845; padding: 20px; border-radius: 10px; text-align: center;"><p style="font-size: 2em; margin-bottom: 10px;">🎯</p><p style="color: #555; font-weight: bold;">Focused Topics</p></div><div style="background: #fff; border: 2px solid #2A0845; padding: 20px; border-radius: 10px; text-align: center;"><p style="font-size: 2em; margin-bottom: 10px;">🤝</p><p style="color: #555; font-weight: bold;">Networking</p></div><div style="background: #fff; border: 2px solid #2A0845; padding: 20px; border-radius: 10px; text-align: center;"><p style="font-size: 2em; margin-bottom: 10px;">💡</p><p style="color: #555; font-weight: bold;">Innovation</p></div></div></div>'
            ]
        );

        Call::firstOrCreate(
            [
                'page_id' => $callsPage->id,
                'type' => 'demo'
            ],
            [
                'title' => 'Call for Demonstrations',
                'content' => '<div style="max-width: 900px; margin: 0 auto; padding: 20px;"><div style="text-align: center; margin-bottom: 30px;"><img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=800&h=400&fit=crop" alt="Demonstrations" style="width: 100%; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"/></div><h2 style="color: #2A0845; margin-bottom: 20px;">Call for Demonstrations</h2><p style="font-size: 1.1em; line-height: 1.9; color: #333; margin-bottom: 25px;">We invite submissions of demonstration proposals showcasing innovative multimedia systems and applications. Demonstrations provide a unique opportunity to present working systems, interact with conference attendees, and receive valuable feedback from the research community.</p><h3 style="color: #2A0845; margin-top: 30px; margin-bottom: 15px;">What to Include</h3><div style="background: #f8f9fa; padding: 25px; border-radius: 10px; margin: 20px 0;"><ul style="font-size: 1.1em; line-height: 2.2; color: #333;"><li>📄 2-page description of the system</li><li>🔧 Technical contributions and innovations</li><li>🎬 Multimedia content examples</li><li>💻 System requirements and setup</li><li>📸 Screenshots or video links</li><li>🌐 Live demo URL (if available)</li></ul></div><div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); padding: 25px; border-radius: 10px; color: white; margin: 30px 0; text-align: center;"><p style="font-size: 1.2em; font-weight: bold; margin-bottom: 10px;">✨ Showcase Your Innovation</p><p style="font-size: 1em; opacity: 0.9;">Demonstrations are an excellent way to showcase practical applications and receive direct feedback from the community.</p></div></div>'
            ]
        );

        // Create Authors content for Authors page with rich formatting
        Author::firstOrCreate(
            [
                'page_id' => $authorsPage->id
            ],
            [
                'content' => '<div style="max-width: 1000px; margin: 0 auto; padding: 20px;"><h1 style="color: #2A0845; text-align: center; margin-bottom: 30px;">Author Guidelines</h1><div style="margin: 30px 0; text-align: center;"><img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1000&h=500&fit=crop" alt="Author Guidelines" style="width: 100%; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"/></div><p style="font-size: 1.2em; line-height: 1.9; color: #333; margin-bottom: 30px; text-align: center;">We welcome submissions from researchers and practitioners worldwide. Please follow these comprehensive guidelines when preparing your submission to ensure a smooth review process.</p><div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin: 40px 0;"><div style="background: #fff; border: 2px solid #2A0845; padding: 30px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"><h2 style="color: #2A0845; margin-bottom: 20px; font-size: 1.8em;">📄 Paper Format</h2><ul style="font-size: 1.1em; line-height: 2.2; color: #555;"><li>Papers must be written in English</li><li>Use the ACM template (available on the conference website)</li><li>Maximum length: 8 pages (including references)</li><li>Submit in PDF format only</li><li>Font size: 10pt minimum</li><li>Page size: US Letter (8.5" x 11")</li></ul></div><div style="background: #fff; border: 2px solid #2A0845; padding: 30px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"><h2 style="color: #2A0845; margin-bottom: 20px; font-size: 1.8em;">📤 Submission Process</h2><ol style="font-size: 1.1em; line-height: 2.2; color: #555;"><li>Prepare your paper following the formatting guidelines</li><li>Submit through the conference submission system</li><li>Wait for review notification</li><li>Submit camera-ready version if accepted</li><li>Register for the conference</li><li>Prepare your presentation</li></ol></div><div style="background: #fff; border: 2px solid #2A0845; padding: 30px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"><h2 style="color: #2A0845; margin-bottom: 20px; font-size: 1.8em;">✅ Review Process</h2><p style="font-size: 1.1em; line-height: 1.9; color: #555; margin-bottom: 15px;">All submissions will undergo a double-blind peer review process. Reviewers will evaluate papers based on:</p><ul style="font-size: 1.1em; line-height: 2.2; color: #555;"><li>Originality and novelty</li><li>Technical quality</li><li>Significance and impact</li><li>Clarity of presentation</li><li>Experimental validation</li></ul></div></div><h2 style="color: #2A0845; margin-top: 50px; margin-bottom: 20px;">Template and Resources</h2><div style="background: #f8f9fa; padding: 30px; border-radius: 10px; margin: 30px 0;"><p style="font-size: 1.1em; line-height: 1.9; color: #333; margin-bottom: 20px;">Download the official ACM template and additional resources:</p><div style="display: flex; gap: 15px; flex-wrap: wrap;"><a href="#" style="background: #2A0845; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold;">📥 Download ACM Template</a><a href="#" style="background: #667eea; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold;">📋 Submission Checklist</a><a href="#" style="background: #f5576c; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold;">❓ FAQ</a></div></div></div>'
            ]
        );

        // Create Organizations for Organization page
        Organization::firstOrCreate(
            [
                'page_id' => $conferencePage->id,
                'name' => 'ACM SIGMM'
            ],
            [
                'category' => 'Technical Co-Sponsor',
                'affiliation' => 'Association for Computing Machinery',
                'photo_url' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=200&h=200&fit=crop'
            ]
        );

        Organization::firstOrCreate(
            [
                'page_id' => $conferencePage->id,
                'name' => 'IEEE Computer Society'
            ],
            [
                'category' => 'Technical Co-Sponsor',
                'affiliation' => 'Institute of Electrical and Electronics Engineers',
                'photo_url' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=200&h=200&fit=crop'
            ]
        );

        Organization::firstOrCreate(
            [
                'page_id' => $conferencePage->id,
                'name' => 'University of Technology'
            ],
            [
                'category' => 'Host Institution',
                'affiliation' => 'Local Organizing Committee',
                'photo_url' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=200&h=200&fit=crop'
            ]
        );

        Organization::firstOrCreate(
            [
                'page_id' => $conferencePage->id,
                'name' => 'Research Lab Inc.'
            ],
            [
                'category' => 'Gold Sponsor',
                'affiliation' => 'Industry Partner',
                'photo_url' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=200&h=200&fit=crop'
            ]
        );

        Organization::firstOrCreate(
            [
                'page_id' => $conferencePage->id,
                'name' => 'Tech Solutions Ltd.'
            ],
            [
                'category' => 'Silver Sponsor',
                'affiliation' => 'Industry Partner',
                'photo_url' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=200&h=200&fit=crop'
            ]
        );

        // Create Conference information with rich content
        Conference::firstOrCreate(
            [
                'page_id' => $conferencePage->id
            ],
            [
                'content' => '<div style="max-width: 1000px; margin: 0 auto; padding: 20px;"><h1 style="color: #2A0845; text-align: center; margin-bottom: 30px;">About MMM 2027</h1><div style="margin: 30px 0;"><img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=1000&h=500&fit=crop" alt="Conference" style="width: 100%; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"/></div><p style="font-size: 1.2em; line-height: 1.9; color: #333; margin-bottom: 30px;">The 33rd International Conference on Multimedia Modeling (MMM 2027) will bring together researchers and practitioners from academia and industry to share the latest advances in multimedia modeling, analysis, and applications.</p><div style="background: #2A0845; padding: 40px; border-radius: 8px; color: white; margin: 40px 0; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"><h2 style="font-size: 2em; margin-bottom: 30px; text-align: center;">Conference Venue</h2><div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;"><div style="background: rgba(255,255,255,0.1); padding: 25px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2);"><h3 style="font-size: 1.5em; margin-bottom: 15px;">🏛️ Venue</h3><p style="font-size: 1.2em; font-weight: bold;">University of Technology</p><p style="font-size: 1em; margin-top: 10px; opacity: 0.9;">State-of-the-art facilities</p></div><div style="background: rgba(255,255,255,0.1); padding: 25px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2);"><h3 style="font-size: 1.5em; margin-bottom: 15px;">📍 Address</h3><p style="font-size: 1.1em;">123 Main Street</p><p style="font-size: 1.1em;">City, Country</p></div><div style="background: rgba(255,255,255,0.1); padding: 25px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2);"><h3 style="font-size: 1.5em; margin-bottom: 15px;">🚇 Access</h3><p style="font-size: 1.1em;">Easily accessible by</p><p style="font-size: 1.1em;">public transportation</p></div></div></div><div style="margin: 40px 0;"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.184132576687!2d-73.98811768459418!3d40.75889597932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes%20Square!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus" width="100%" height="450" style="border:0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div><h2 style="color: #2A0845; margin-top: 50px; margin-bottom: 20px;">Important Information</h2><div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 30px 0;"><div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #2A0845;"><p style="font-weight: bold; color: #2A0845; margin-bottom: 10px;">📅 Conference Dates</p><p style="color: #555; font-size: 1.1em;">June 15-17, 2025</p></div><div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #2A0845;"><p style="font-weight: bold; color: #2A0845; margin-bottom: 10px;">📝 Registration Opens</p><p style="color: #555; font-size: 1.1em;">March 1, 2025</p></div><div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #2A0845;"><p style="font-weight: bold; color: #2A0845; margin-bottom: 10px;">💰 Early Bird Deadline</p><p style="color: #555; font-size: 1.1em;">March 1, 2025</p></div></div></div>',
                'json' => [
                    'venue' => 'University of Technology',
                    'address' => '123 Main Street, City, Country',
                    'dates' => [
                        'start' => '2025-06-15',
                        'end' => '2025-06-17'
                    ],
                    'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.184132576687!2d-73.98811768459418!3d40.75889597932681'
                ]
            ]
        );

        $this->command->info('Test data seeded successfully!');
        $this->command->info('Created data for: Pages, Keynotes, News, FAQs, Important Dates, Calls, Authors, Organizations, and Conference');
    }
}
