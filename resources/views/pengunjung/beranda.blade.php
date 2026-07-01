<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JEBOL - Jemput Bola Online Disdukcapil Tegal</title>
    <meta name="description" content="Layanan Jemput Bola Online memudahkan warga Kota Tegal mengurus KTP, KIA, Akta Kelahiran, dan dokumen kependudukan lainnya dari kenyamanan rumah Anda.">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @include('partials.head-dependencies')
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary: #003178;
            --primary-dark: #002252;
            --primary-light: #e0f2fe;
            --accent: #FFC107;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            background-color: #f8faff;
            background-image: url('{{ asset('img/batik-pattern.png') }}');
            background-size: 400px;
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .content-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 24px;
            width: 100%;
        }

        /* Hero Section */
        .hero-premium {
            position: relative;
            height: 90vh;
            min-height: 700px;
            width: 100%;
            background: #003178;
            overflow: visible !important;
        }



        .hero-slider {
            height: 100%;
            width: 100%;
            position: relative;
            overflow: visible !important;
        }


        .slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            visibility: hidden;
            transition: all 1s ease-in-out;
            display: flex;
            align-items: center;
            background-size: cover;
            background-position: center;
        }

        .slide.active {
            opacity: 1;
            visibility: visible;
            z-index: 5;
        }

        .slide::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(rgba(0, 49, 120, 0.8), rgba(0, 49, 120, 0.55));
            z-index: 2;
        }

        .slide-content {
            position: relative;
            z-index: 10;
            width: 100%;
            padding-top: 140px;
        }

        .hero-title {
            font-size: clamp(2rem, 5vw, 4rem) !important;
            font-weight: 900 !important;
            line-height: 1.1 !important;
            margin-bottom: 24px !important;
            color: white !important;
        }

        .hero-subtitle {
            font-size: clamp(1rem, 1.5vw, 1.2rem) !important;
            max-width: 650px !important;
            margin-bottom: 40px !important;
            color: rgba(255,255,255,0.9) !important;
            line-height: 1.6 !important;
        }

        /* Custom Transitions */
        .slide-up {
            animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .premium-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 100px;
            font-size: 12px;
            font-weight: 700;
            color: white;
            margin-bottom: 24px;
        }

        .premium-badge .dot {
            width: 8px;
            height: 8px;
            background: #FFC107;
            border-radius: 50%;
            box-shadow: 0 0 10px #FFC107;
        }

        .btn-premium {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            background: white;
            color: var(--primary);
            border-radius: 16px;
            font-weight: 800;
            font-size: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .btn-premium:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
            background: var(--primary);
            color: white;
        }

        .btn-glass {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 16px;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        /* Stats Card */
        .stats-float-wrapper {
            position: relative;
            background: #ffffff;
            z-index: 40;
            padding: 40px 0;
            box-shadow: 0 4px 20px rgba(0, 49, 120, 0.08);
            border-bottom: 1px solid rgba(0, 49, 120, 0.06);
        }

        .stats-float-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 40px;
            padding: 40px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 25px 50px -12px rgba(0, 49, 120, 0.25);
        }


        .stat-box {
            text-align: center;
            padding: 0 20px;
            border-right: 1px solid rgba(0, 49, 120, 0.1);
        }

        .stat-box:last-child { border-right: none; }

        .stat-num {
            display: block;
            font-size: 32px;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 10px;
            font-weight: 800;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        @media (max-width: 1024px) {
            .stats-float-card { 
                grid-template-columns: repeat(4, 1fr); 
                gap: 10px; 
                padding: 24px; 
            }
            .stat-box { border-right: 1px solid rgba(0, 49, 120, 0.1); padding: 0 10px; }
            .stat-box:last-child { border-right: none; }
            .stat-num { font-size: 26px; }
        }

        @media (max-width: 768px) {
            .stats-float-wrapper {
                padding: 8px 0 !important;
            }
            .stats-float-card {
                display: grid !important;
                grid-template-columns: repeat(4, 1fr) !important;
                padding: 0 !important;
                gap: 0 !important;
                border-radius: 12px !important;
                box-shadow: none !important;
            }
            .stat-box {
                border-right: 1px solid rgba(0, 49, 120, 0.1) !important;
                border-bottom: none !important;
                padding: 10px 4px !important;
                text-align: center !important;
                border-left: none !important;
                border-top: none !important;
            }
            .stat-box:last-child { border-right: none !important; }
            .stat-num { font-size: 13px !important; margin-bottom: 2px !important; display: block !important; font-weight: 900 !important; }
            .stat-label { font-size: 6px !important; letter-spacing: 0.3px !important; line-height: 1.2 !important; }

            /* Fix hero height on mobile - slides are absolute so need explicit height */
            .hero-premium {
                height: 55vh !important;
                min-height: 420px !important;
                padding-bottom: 0 !important;
                overflow: visible !important;
            }
            .hero-slider {
                height: 100% !important;
            }
            .slide-content {
                padding-top: 80px !important;
                padding-bottom: 40px !important;
            }
        }

        .features {
            padding: 120px 0 80px;
            margin-top: 40px;
            position: relative;
            z-index: 10;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .features .section-header h2 {
            color: #ffffff !important;
        }

        .features .section-header p {
            color: #cbd5e1 !important;
        }

        .steps { background-color: #ffffff !important; }
        .testimonials { background-color: #f8fafc !important; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; }
        .faq { background-color: #ffffff !important; }
        .maps { background-color: #f8fafc !important; border-top: 1px solid #f1f5f9; }
        
        .stats-float-card {
            border: 1px solid rgba(0, 49, 120, 0.08) !important;
            box-shadow: 0 25px 50px -12px rgba(0, 49, 120, 0.15) !important;
        }

        /* Feature Cards Enhancement */
        .feature-card {
            background: rgba(255, 255, 255, 0.03) !important;
            backdrop-filter: blur(15px) !important;
            border-radius: 32px !important;
            padding: 40px !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2) !important;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
            position: relative;
            z-index: 1;
        }

        .feature-card:hover {
            transform: translateY(-10px) !important;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4) !important;
            border-color: rgba(255, 255, 255, 0.3) !important;
            background: rgba(255, 255, 255, 0.06) !important;
        }

        .feature-icon {
            width: 70px !important;
            height: 70px !important;
            border-radius: 20px !important;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
            color: #ffffff !important;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px !important;
            transition: all 0.4s ease !important;
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3) !important;
        }

        .feature-icon svg {
            width: 32px !important;
            height: 32px !important;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg) !important;
            box-shadow: 0 15px 30px rgba(245, 158, 11, 0.4) !important;
        }

        .feature-card h3 {
            font-family: 'Outfit', sans-serif !important;
            font-size: 1.5rem !important;
            font-weight: 800 !important;
            color: #ffffff !important;
            margin-bottom: 16px !important;
        }

        .feature-card p {
            font-size: 1.05rem !important;
            line-height: 1.6 !important;
            color: #cbd5e1 !important;
        }

        /* Mobile: compact feature cards so all 3 fit on one screen */
        @media (max-width: 480px) {
            .features-grid {
                gap: 10px !important;
            }
            .features .section-header {
                margin-bottom: 20px !important;
            }
            .features .section-header h2 {
                font-size: 1.4rem !important;
                margin-bottom: 6px !important;
            }
            .features .section-header p {
                font-size: 0.85rem !important;
            }
            .feature-card {
                padding: 14px 16px !important;
                border-radius: 16px !important;
            }
            .feature-icon {
                width: 40px !important;
                height: 40px !important;
                border-radius: 11px !important;
                margin-bottom: 8px !important;
            }
            .feature-icon svg {
                width: 20px !important;
                height: 20px !important;
            }
            .feature-card h3 {
                font-size: 0.95rem !important;
                margin-bottom: 4px !important;
            }
            .feature-card p {
                font-size: 0.78rem !important;
                line-height: 1.4 !important;
            }
        }

        /* View All Button */
        .btn-view-all {
            background: linear-gradient(135deg, #003178 0%, #001e50 100%) !important;
            color: white !important;
            border: none !important;
            padding: 18px 40px !important;
            border-radius: 100px !important;
            font-weight: 700 !important;
            letter-spacing: 0.5px !important;
            box-shadow: 0 10px 25px rgba(0, 49, 120, 0.2) !important;
            transition: all 0.3s ease !important;
        }

        .btn-view-all:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 15px 35px rgba(0, 49, 120, 0.3) !important;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
            color: white !important;
        }

        /* Steps Section Enhancement */
        .steps {
            padding: 120px 0 !important;
            background: #ffffff !important;
        }

        .steps-info {
            padding: 40px;
            background: #f8fafc;
            border-radius: 32px;
            border: 1px solid rgba(0, 49, 120, 0.05);
        }

        .steps-list {
            display: flex;
            flex-direction: column;
            gap: 24px !important;
            position: relative;
        }

        .steps-list::before {
            content: '';
            position: absolute;
            left: 52px;
            top: 20px;
            bottom: 20px;
            width: 2px;
            background: #e2e8f0;
            z-index: 1;
        }

        .step-item {
            display: flex;
            gap: 24px;
            position: relative;
            z-index: 2;
            background: white;
            padding: 24px;
            border-radius: 24px;
            box-shadow: 0 4px 15px rgba(0, 49, 120, 0.03);
            border: 1px solid rgba(0, 49, 120, 0.04);
            transition: all 0.3s ease;
        }

        .step-item:hover {
            transform: translateX(10px);
            box-shadow: 0 15px 30px rgba(0, 49, 120, 0.08);
            border-color: #3b82f6;
        }

        .step-number {
            width: 60px !important;
            height: 60px !important;
            flex-shrink: 0;
            background: linear-gradient(135deg, #003178 0%, #001e50 100%) !important;
            color: white !important;
            border-radius: 18px !important;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif !important;
            font-size: 1.5rem !important;
            font-weight: 800 !important;
            opacity: 1 !important;
            box-shadow: 0 8px 20px rgba(0, 49, 120, 0.2);
            border: 4px solid white;
            transition: all 0.4s ease;
        }

        .step-item:hover .step-number {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
            transform: scale(1.05) rotate(-5deg);
        }

        .step-text {
            padding-top: 6px;
        }

        .step-text h4 {
            font-family: 'Outfit', sans-serif !important;
            font-size: 1.25rem !important;
            font-weight: 800 !important;
            color: #0f172a !important;
            margin-bottom: 8px !important;
        }

        .step-text p {
            color: #475569 !important;
            line-height: 1.6 !important;
            font-size: 0.95rem !important;
        }

        /* FAQ Section Enhancement */
        .faq {
            padding: 100px 0 !important;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%) !important;
            position: relative;
        }

        .faq .section-header h2 {
            color: #ffffff !important;
        }

        .faq .section-header p {
            color: #cbd5e1 !important;
        }

        .faq-list {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .faq-item {
            background: rgba(255, 255, 255, 0.03) !important;
            backdrop-filter: blur(15px) !important;
            border-radius: 20px !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4) !important;
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.2) !important;
            background: rgba(255, 255, 255, 0.06) !important;
        }

        .faq-question {
            padding: 24px 32px !important;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            border-bottom: 1px solid transparent;
            transition: all 0.3s ease;
        }

        .faq-item.active .faq-question {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        .faq-question h4 {
            font-size: 1.15rem !important;
            font-weight: 700 !important;
            color: #ffffff !important;
            margin: 0 !important;
            font-family: 'Outfit', sans-serif !important;
        }

        .faq-icon {
            color: #ffffff !important;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.4s ease;
            flex-shrink: 0;
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3) !important;
        }

        .faq-item.active .faq-icon {
            transform: rotate(45deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: rgba(0, 0, 0, 0.2);
        }

        .faq-item.active .faq-answer {
            max-height: 300px;
        }

        .faq-answer p {
            padding: 20px 32px 32px 32px !important;
            color: #cbd5e1 !important;
            line-height: 1.7 !important;
            margin: 0 !important;
            font-size: 1rem !important;
        }

        /* Mobile: FAQ fixes */
        @media (max-width: 768px) {
            .faq {
                padding: 48px 0 !important;
            }
            .faq .section-header {
                margin-bottom: 24px !important;
                text-align: center;
            }
            .faq .section-header h2 {
                font-size: 1.5rem !important;
            }
            .faq-list {
                gap: 10px !important;
                max-width: 100% !important;
            }
            .faq-item {
                border-radius: 14px !important;
                overflow: hidden !important;
            }
            .faq-item:hover {
                transform: none !important;
            }
            .faq-question {
                padding: 14px 16px !important;
                align-items: flex-start !important;
                gap: 12px !important;
            }
            .faq-question h4 {
                font-size: 0.85rem !important;
                line-height: 1.4 !important;
                flex: 1;
            }
            .faq-icon {
                width: 28px !important;
                height: 28px !important;
                flex-shrink: 0 !important;
                margin-top: 2px !important;
            }
            .faq-icon svg {
                width: 14px !important;
                height: 14px !important;
            }
            .faq-answer {
                overflow: hidden !important;
            }
            .faq-answer p {
                padding: 12px 16px 16px 16px !important;
                font-size: 0.82rem !important;
                line-height: 1.6 !important;
            }
        }
        /* Schedule Section Enhancement */
        .schedule {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%) !important;
            padding: 100px 60px !important;
            border-radius: 40px !important;
            margin: 60px 24px !important;
            position: relative;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(15, 23, 42, 0.4);
        }

        .schedule::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -10%;
            width: 50%;
            height: 150%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.2) 0%, transparent 70%);
            transform: rotate(-45deg);
            pointer-events: none;
        }

        .schedule::after {
            content: '';
            position: absolute;
            bottom: -50%;
            right: -10%;
            width: 50%;
            height: 150%;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .schedule .section-header h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 12px;
        }

        .schedule .section-header p {
            color: #94a3b8;
            font-size: 1.1rem;
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            position: relative;
            z-index: 10;
        }

        .schedule-card {
            background: rgba(255, 255, 255, 0.05) !important;
            backdrop-filter: blur(20px) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 24px !important;
            padding: 32px 24px !important;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
            text-align: center;
        }

        .schedule-card:hover {
            background: rgba(255, 255, 255, 0.1) !important;
            transform: translateY(-10px) !important;
            border-color: rgba(255, 255, 255, 0.3) !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), 0 0 20px rgba(59, 130, 246, 0.4) !important;
        }

        .schedule-card h4 {
            font-family: 'Outfit', sans-serif;
            color: #f59e0b !important;
            font-size: 1.1rem !important;
            font-weight: 800 !important;
            letter-spacing: 2px !important;
            margin-bottom: 16px !important;
        }

        .schedule-card p {
            font-size: 1.25rem !important;
            font-weight: 700 !important;
            color: #ffffff !important;
            margin-bottom: 16px !important;
        }

        .schedule-card span {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 0.9rem !important;
            color: #cbd5e1 !important;
            font-weight: 600;
        }

        .btn-white {
            background: #ffffff !important;
            color: #0f172a !important;
            padding: 16px 32px !important;
            border-radius: 100px !important;
            font-weight: 800 !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
            transition: all 0.3s ease !important;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .btn-white:hover {
            background: #f59e0b !important;
            color: #ffffff !important;
            transform: translateY(-3px) !important;
            box-shadow: 0 15px 30px rgba(245, 158, 11, 0.3) !important;
        }

        /* Mobile: schedule section fixes */
        @media (max-width: 768px) {
            .schedule {
                padding: 48px 24px !important;
                border-radius: 24px !important;
                margin: 20px 12px !important;
            }
            .schedule .section-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 16px !important;
                margin-bottom: 28px !important;
            }
            .schedule .section-header h2 {
                font-size: 1.8rem !important;
                margin-bottom: 6px !important;
            }
            .schedule .section-header p {
                font-size: 0.9rem !important;
            }
            .btn-white {
                padding: 12px 22px !important;
                font-size: 0.85rem !important;
                align-self: flex-start !important;
            }
            .schedule-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 12px !important;
            }
            .schedule-card {
                padding: 20px 16px !important;
                border-radius: 16px !important;
            }
            .schedule-card h4 {
                font-size: 0.85rem !important;
                letter-spacing: 1px !important;
                margin-bottom: 8px !important;
            }
            .schedule-card p {
                font-size: 1rem !important;
                margin-bottom: 10px !important;
            }
            .schedule-card span {
                font-size: 0.75rem !important;
                padding: 5px 10px !important;
            }
        }

        /* Maps Section Enhancement */
        .maps {
            padding: 120px 0 !important;
            background: #ffffff !important;
        }

        .maps-container {
            display: grid !important;
            grid-template-columns: 1fr 1.5fr !important;
            gap: 0 !important;
            background: #f8fafc !important;
            padding: 0 !important;
            align-items: stretch !important;
            box-shadow: inset 0 10px 30px rgba(0, 49, 120, 0.03) !important;
            border-radius: 0 !important;
        }

        .maps-info {
            display: flex !important;
            flex-direction: column !important;
            gap: 24px !important;
            justify-content: center !important;
            padding: 60px 5% 60px 10% !important;
        }

        .info-card {
            background: #ffffff !important;
            padding: 24px !important;
            border-radius: 20px !important;
            display: flex !important;
            align-items: flex-start !important;
            gap: 20px !important;
            box-shadow: 0 10px 20px rgba(0, 49, 120, 0.03) !important;
            border: 1px solid rgba(0, 49, 120, 0.05) !important;
            transition: all 0.3s ease !important;
        }

        .info-card:hover {
            transform: translateX(10px) !important;
            box-shadow: 0 15px 30px rgba(0, 49, 120, 0.08) !important;
            border-color: #3b82f6 !important;
        }

        .info-icon {
            color: #ffffff !important;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
            width: 48px !important;
            height: 48px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 50% !important;
            flex-shrink: 0 !important;
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3) !important;
        }

        .info-card h4 {
            font-family: 'Outfit', sans-serif !important;
            font-size: 1.15rem !important;
            font-weight: 800 !important;
            color: #0f172a !important;
            margin-top: 0 !important;
            margin-bottom: 8px !important;
        }

        .info-card p {
            color: #475569 !important;
            line-height: 1.6 !important;
            margin: 0 !important;
            font-size: 0.95rem !important;
        }

        .maps-frame {
            border-radius: 0 !important;
            overflow: hidden !important;
            box-shadow: none !important;
            height: 100% !important;
            min-height: 400px !important;
        }
        
        .maps-frame iframe {
            width: 100% !important;
            height: 100% !important;
            min-height: 400px !important;
            display: block !important;
        }

        /* Mobile: maps section fixes */
        @media (max-width: 768px) {
            .maps {
                padding: 48px 0 0 0 !important;
            }
            .maps .section-header {
                margin-bottom: 28px !important;
                padding: 0 16px !important;
            }
            .maps .section-header h2 {
                font-size: 1.8rem !important;
            }
            .maps .section-header p {
                font-size: 0.9rem !important;
            }
            .maps-container {
                grid-template-columns: 1fr !important;
            }
            .maps-info {
                padding: 0 16px 24px 16px !important;
                gap: 12px !important;
            }
            .info-card {
                padding: 16px !important;
                gap: 14px !important;
            }
            .info-card:hover {
                transform: none !important;
            }
            .info-icon {
                width: 40px !important;
                height: 40px !important;
                flex-shrink: 0 !important;
            }
            .info-card h4 {
                font-size: 0.95rem !important;
                margin-bottom: 4px !important;
            }
            .info-card p {
                font-size: 0.82rem !important;
                line-height: 1.5 !important;
            }
            .maps-frame {
                min-height: 260px !important;
            }
            .maps-frame iframe {
                min-height: 260px !important;
            }
        }

        /* CTA Section Enhancement */
        .cta {
            padding: 80px 0 120px 0 !important;
            background: #ffffff !important;
            position: relative;
        }

        .cta-bg-elements {
            display: none !important;
        }

        .cta-container {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%) !important;
            border-radius: 40px !important;
            padding: 80px 40px !important;
            text-align: center !important;
            position: relative;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(15, 23, 42, 0.3) !important;
        }
        
        .cta-container::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 2px, transparent 2px);
            background-size: 30px 30px;
            opacity: 0.5;
            pointer-events: none;
        }

        .cta-container h2 {
            color: #ffffff !important;
            font-size: 2.5rem !important;
            font-weight: 800 !important;
            margin-bottom: 20px !important;
            position: relative;
            z-index: 1;
            font-family: 'Outfit', sans-serif !important;
        }

        .cta-container p {
            color: #cbd5e1 !important;
            font-size: 1.1rem !important;
            max-width: 600px;
            margin: 0 auto 40px auto !important;
            position: relative;
            z-index: 1;
            line-height: 1.6 !important;
        }

        .cta-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            position: relative;
            z-index: 1;
        }

        .cta-actions .btn-primary {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
            color: white !important;
            border: none !important;
            padding: 16px 36px !important;
            border-radius: 100px !important;
            font-weight: 800 !important;
            font-size: 1.1rem !important;
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3) !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
            display: inline-block;
        }

        .cta-actions .btn-primary:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 15px 30px rgba(245, 158, 11, 0.4) !important;
        }

        .cta-actions .btn-outline {
            background: rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
            border: 2px solid rgba(255, 255, 255, 0.2) !important;
            padding: 14px 36px !important;
            border-radius: 100px !important;
            font-weight: 800 !important;
            font-size: 1.1rem !important;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease !important;
            text-decoration: none !important;
            display: inline-block;
        }

        .cta-actions .btn-outline:hover {
            background: rgba(255, 255, 255, 0.2) !important;
            border-color: rgba(255, 255, 255, 0.4) !important;
            transform: translateY(-3px) !important;
        }

        .btn-testimoni {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 16px 36px !important;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
            color: white !important;
            font-weight: 800 !important;
            border-radius: 100px !important;
            text-decoration: none !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3) !important;
            border: none !important;
        }

        .btn-testimoni:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 15px 30px rgba(245, 158, 11, 0.4) !important;
            color: white !important;
        }

        /* ============================================
           COMPREHENSIVE MOBILE RESPONSIVE STYLES
           Covers ALL sections of the homepage
        ============================================ */

        @media (max-width: 768px) {

            /* --- Global --- */
            .content-container {
                padding: 0 16px !important;
            }

            /* --- Hero Section --- */
            .hero-premium {
                height: 55vh !important;
                min-height: 420px !important;
                padding-bottom: 0 !important;
            }
            .slide-content {
                padding-top: 80px !important;
                padding-bottom: 40px !important;
            }
            .hero-title {
                font-size: 1.8rem !important;
                line-height: 1.2 !important;
                margin-bottom: 14px !important;
            }
            .hero-subtitle {
                font-size: 0.9rem !important;
                margin-bottom: 24px !important;
            }
            .hero-btns {
                display: flex !important;
                flex-wrap: wrap !important;
                gap: 10px !important;
            }
            .btn-premium, .btn-glass {
                padding: 12px 20px !important;
                font-size: 0.85rem !important;
                border-radius: 12px !important;
            }
            .premium-badge {
                font-size: 10px !important;
                padding: 6px 12px !important;
                margin-bottom: 14px !important;
            }

            /* --- Stats Float Card --- */
            .stats-float-wrapper {
                padding: 8px 0 !important;
            }
            .stats-float-card {
                display: grid !important;
                grid-template-columns: repeat(4, 1fr) !important;
                padding: 0 !important;
                gap: 0 !important;
                border-radius: 12px !important;
                box-shadow: none !important;
            }
            .stat-box {
                border-right: 1px solid rgba(0, 49, 120, 0.1) !important;
                border-bottom: none !important;
                padding: 10px 4px !important;
                text-align: center !important;
            }
            .stat-box:last-child { border-right: none !important; }
            .stat-num { font-size: 13px !important; margin-bottom: 2px !important; display: block !important; font-weight: 900 !important; }
            .stat-label { font-size: 6px !important; letter-spacing: 0.3px !important; line-height: 1.2 !important; }

            /* --- Features Section --- */
            .features {
                padding: 60px 0 60px !important;
                margin-top: 0 !important;
            }
            .features .section-header {
                margin-bottom: 24px !important;
            }
            .features .section-header h2 {
                font-size: 1.6rem !important;
            }
            .features .section-header p {
                font-size: 0.88rem !important;
            }
            .features-grid {
                grid-template-columns: 1fr !important;
                gap: 16px !important;
            }
            .feature-card {
                padding: 24px !important;
                border-radius: 20px !important;
            }
            .feature-icon {
                width: 52px !important;
                height: 52px !important;
                margin-bottom: 16px !important;
            }
            .feature-card h3 {
                font-size: 1.1rem !important;
                margin-bottom: 10px !important;
            }
            .feature-card p {
                font-size: 0.88rem !important;
            }

            /* --- Steps Section --- */
            .steps {
                padding: 60px 0 !important;
            }
            .steps-content {
                grid-template-columns: 1fr !important;
            }
            .steps-image {
                display: none !important;
            }
            .steps-info {
                padding: 24px 16px !important;
                border-radius: 20px !important;
            }
            .steps-info .section-header {
                margin-bottom: 24px !important;
            }
            .steps-info .section-header h2 {
                font-size: 1.6rem !important;
            }
            .steps-list {
                gap: 14px !important;
            }
            .steps-list::before {
                left: 42px !important;
            }
            .step-item {
                padding: 16px !important;
                gap: 16px !important;
                border-radius: 18px !important;
            }
            .step-item:hover {
                transform: none !important;
            }
            .step-number {
                width: 48px !important;
                height: 48px !important;
                font-size: 1.1rem !important;
                border-radius: 14px !important;
            }
            .step-text h4 {
                font-size: 1rem !important;
                margin-bottom: 4px !important;
            }
            .step-text p {
                font-size: 0.82rem !important;
                line-height: 1.5 !important;
            }

            /* --- FAQ Section --- */
            .faq {
                padding: 60px 0 !important;
            }
            .faq .section-header {
                margin-bottom: 28px !important;
            }
            .faq .section-header h2 {
                font-size: 1.6rem !important;
            }
            .faq-question {
                padding: 16px 20px !important;
            }
            .faq-question h4 {
                font-size: 0.9rem !important;
            }
            .faq-icon {
                width: 28px !important;
                height: 28px !important;
                flex-shrink: 0 !important;
            }
            .faq-answer p {
                padding: 14px 20px 20px 20px !important;
                font-size: 0.85rem !important;
            }

            /* --- Testimonials Section --- */
            .testimonials {
                padding: 60px 0 !important;
            }
            .testimonials .section-header {
                margin-bottom: 32px !important;
            }
            .testimonials .section-header h2 {
                font-size: 1.6rem !important;
            }
            .testimonials-grid {
                grid-template-columns: 1fr !important;
            }
            .testimonial-card {
                padding: 20px !important;
                border-radius: 20px !important;
            }
            .testimonial-text {
                font-size: 0.88rem !important;
                line-height: 1.6 !important;
            }
            .testimonial-user {
                margin-top: 16px !important;
            }
            .user-avatar {
                width: 36px !important;
                height: 36px !important;
                font-size: 0.9rem !important;
            }

            /* --- CTA Section --- */
            .cta {
                padding: 40px 0 60px 0 !important;
            }
            .cta-container {
                border-radius: 24px !important;
                padding: 40px 20px !important;
            }
            .cta-container h2 {
                font-size: 1.6rem !important;
                margin-bottom: 12px !important;
            }
            .cta-container p {
                font-size: 0.88rem !important;
                margin-bottom: 24px !important;
            }
            .cta-actions {
                flex-direction: column !important;
                align-items: center !important;
                gap: 12px !important;
            }
            .cta-actions .btn-primary,
            .cta-actions .btn-outline {
                width: 100% !important;
                text-align: center !important;
                padding: 14px 24px !important;
                font-size: 0.95rem !important;
            }
        }

        /* Extra small screens (≤480px) */
        @media (max-width: 480px) {

            /* Stats: keep 2-col but smaller */
            .stats-float-card {
                margin: 0 8px !important;
                padding: 14px 10px !important;
                gap: 8px !important;
            }
            .stat-num { font-size: 18px !important; }
            .stat-label { font-size: 8px !important; }

            /* Features: 1 column very compact */
            .features {
                margin-top: 50px !important;
                padding: 60px 0 40px !important;
            }
            .features .section-header h2 { font-size: 1.3rem !important; }
            .feature-card {
                padding: 16px !important;
                border-radius: 16px !important;
            }
            .feature-icon {
                width: 42px !important;
                height: 42px !important;
                margin-bottom: 10px !important;
            }
            .feature-icon svg { width: 20px !important; height: 20px !important; }
            .feature-card h3 { font-size: 0.95rem !important; }
            .feature-card p { font-size: 0.78rem !important; }

            /* Hero */
            .hero-title { font-size: 1.5rem !important; }
            .hero-subtitle { font-size: 0.82rem !important; }
        }

    </style>
</head>
<body style="background-color: #ffffff; background-image: none !important;">
    @include('partials.navbar')


    <main>
        <section class="hero-premium jbl-1109 jbl-1293 jbl-1426">


            <div class="hero-slider">
                <!-- Slide 1 -->
                <div class="slide active" style="background-image: url('{{ asset('images/hero-slider-1.png') }}');">
                    <div class="content-container slide-content">
                        <div class="slide-text">
                            <div class="premium-badge">
                                <span class="dot"></span>
                                Portal Resmi Kota Tegal
                            </div>
                            <h1 class="hero-title">
                                Dinas Kependudukan dan <span class="jbl-407">Pencatatan Sipil</span><br>
                                Kota Tegal
                            </h1>
                            <p class="hero-subtitle">
                                Layanan administrasi kependudukan modern yang cepat, transparan, dan terpercaya untuk masyarakat Kota Tegal.
                            </p>
                            <div class="hero-btns">
                                <a href="{{ route('services') }}" class="btn-premium">
                                    🚀 Lihat Layanan
                                </a>
                                <a href="{{ route('contact') }}" class="btn-glass">
                                    📞 Hubungi Kami
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="slide" style="background-image: url('{{ asset('images/hero-slider-2.png') }}');">
                    <div class="content-container slide-content">
                        <div class="slide-text">
                            <div class="premium-badge"><span class="dot"></span> Inovasi Pelayanan</div>
                            <h1 class="hero-title">Pelayanan <span class="jbl-407">Jemput Bola</span> <br> Langsung ke Lokasi</h1>
                            <p class="hero-subtitle">Petugas kami hadir di tengah masyarakat untuk memudahkan pengurusan dokumen kependudukan tanpa harus ke kantor.</p>
                            <div class="hero-btns">
                                <a href="{{ route('jadwal') }}" class="btn-premium">📅 Cek Jadwal</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="slide" style="background-image: url('{{ asset('images/hero-slider-3.png') }}');">
                    <div class="content-container slide-content">
                        <div class="slide-text">
                            <div class="premium-badge"><span class="dot"></span> Kota Tegal Bahari</div>
                            <h1 class="hero-title">Mewujudkan Tegal <br> <span class="jbl-407">Tertib Administrasi</span></h1>
                            <p class="hero-subtitle">Satu data kependudukan untuk akses layanan publik yang lebih baik dan terintegrasi.</p>
                            <div class="hero-btns">
                                <a href="/register" class="btn-premium">📝 Register Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="slide" style="background-image: url('{{ asset('images/hero-slider-4.png') }}');">
                    <div class="content-container slide-content">
                        <div class="slide-text">
                            <div class="premium-badge"><span class="dot"></span> Digitalisasi Data</div>
                            <h1 class="hero-title">Dokumen <span class="jbl-407">Kependudukan</span> <br> Dalam Genggaman</h1>
                            <p class="hero-subtitle">Akses layanan pengajuan dokumen kapan saja dan di mana saja melalui portal online JEBOL.</p>
                            <div class="hero-btns">
                                <a href="{{ route('services') }}" class="btn-premium">📂 Pilih Layanan</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 5 -->
                <div class="slide" style="background-image: url('{{ asset('images/hero-slider-5.png') }}');">
                    <div class="content-container slide-content">
                        <div class="slide-text">
                            <div class="premium-badge"><span class="dot"></span> Komitmen Melayani</div>
                            <h1 class="hero-title">Melayani dengan <br> <span class="jbl-407">Sepenuh Hati</span></h1>
                            <p class="hero-subtitle">Kepuasan Anda adalah prioritas kami. Berikan feedback untuk pelayanan yang lebih baik.</p>
                            <div class="hero-btns">
                                <a href="{{ route('contact') }}" class="btn-premium">
                                    <span style="font-size: 1.1rem; margin-right: 4px;">💬</span> HUBUNGI KAMI
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Slider Nav -->
                <button class="slide-arrow prev"><i data-lucide="chevron-left"></i></button>
                <button class="slide-arrow next"><i data-lucide="chevron-right"></i></button>
            </div>

            </div>
        </section>

        <!-- Stats Section -->
        <div class="stats-float-wrapper">
            <div class="content-container">
                <div class="stats-float-card">
                    <div class="stat-box">
                        <span class="stat-num">{{ $totalServices }}</span>
                        <span class="stat-label">JENIS LAYANAN</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-num">{{ $dokumenTerbit }}</span>
                        <span class="stat-label">DOKUMEN TERBIT</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-num">{{ $persenKepuasan }}%</span>
                        <span class="stat-label">PENILAIAN LAYANAN</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-num">1 Hari</span>
                        <span class="stat-label">RATA RATA PROSES</span>
                    </div>
                </div>
            </div>
        </div>


        <section id="layanan" class="features">
            <div class="content-container">
                <div class="section-header" style="text-align: center; margin-bottom: 48px;">
                    <h2>Layanan Jemput Bola Kota Tegal</h2>
                    <p>Pelayanan kependudukan dan pencatatan sipil untuk masyarakat Kota Tegal</p>
                </div>
                
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i data-lucide="badge"></i>
                        </div>
                        <h3>KTP-el</h3>
                        <p>Layanan rekam dan cetak baru, ganti rusak/hilang untuk Kartu Tanda Penduduk elektronik Kota Tegal.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i data-lucide="baby"></i>
                        </div>
                        <h3>Kartu Identitas Anak</h3>
                        <p>Penerbitan kartu identitas resmi untuk anak usia 0-17 tahun sebagai bukti diri yang sah.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i data-lucide="smartphone"></i>
                        </div>
                        <h3>Aktivasi IKD</h3>
                        <p>Aktivasi Identitas Kependudukan Digital (Digital ID) untuk akses layanan publik dalam genggaman.</p>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 48px;">
                    <a href="{{ route('services') }}" class="btn-testimoni">
                        Lihat Semua Layanan <i data-lucide="arrow-right" width="18" height="18" style="margin-left: 8px;"></i>
                    </a>
                </div>
            </div>
        </section>

        <section id="panduan" class="steps">
            <div class="content-container steps-content">
                <div class="steps-image">
                    <img src="{{ asset('images/steps.png') }}" alt="Administrative Process Flow">
                </div>
                
                <div class="steps-info">
                    <div class="section-header" style="margin-bottom: 40px;">
                        <h2>Panduan Layanan</h2>
                        <p>Ikuti langkah-langkah mudah berikut untuk mengurus dokumen kependudukan Anda secara online.</p>
                    </div>
                    
                    <div class="steps-list">
                        <div class="step-item">
                            <div class="step-number">01</div>
                            <div class="step-text">
                                <h4>Ajukan Permohonan</h4>
                                <p>Pilih layanan dokumen yang dibutuhkan melalui portal JEBOL dan lengkapi data formulir secara online.</p>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number">02</div>
                            <div class="step-text">
                                <h4>Unggah Persyaratan</h4>
                                <p>Foto atau scan dokumen persyaratan asli Anda, lalu unggah ke sistem untuk verifikasi awal oleh petugas.</p>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number">03</div>
                            <div class="step-text">
                                <h4>Verifikasi & Jadwal</h4>
                                <p>Petugas akan memeriksa berkas Anda. Jika sesuai, Anda akan mendapatkan notifikasi jadwal petugas JEBOL datang ke lokasi Anda.</p>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number">04</div>
                            <div class="step-text">
                                <h4>Pelayanan di Lokasi</h4>
                                <p>Petugas JEBOL hadir di lokasi sesuai jadwal untuk proses perekaman/pengesahan dan dokumen langsung diproses.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="jadwal" class="schedule">
            <div class="content-container">
                <div class="section-header">
                    <div>
                        <h2>Informasi Jadwal Layanan</h2>
                        <p>Update jadwal operasional dan lokasi jemput bola minggu ini.</p>
                    </div>
                    <a href="/jadwal" class="btn btn-white">
                        <i data-lucide="calendar" width="18" height="18" style="margin-right: 8px;"></i> Lihat Jadwal Lengkap
                    </a>
                </div>
                
                <div class="schedule-grid">
                    <div class="schedule-card">
                        <h4>Senin</h4>
                        <p>Kec. Tegal Barat</p>
                        <span>08:00 - 14:00 WIB</span>
                    </div>
                    <div class="schedule-card">
                        <h4>Selasa</h4>
                        <p>Kec. Tegal Timur</p>
                        <span>08:00 - 14:00 WIB</span>
                    </div>
                    <div class="schedule-card">
                        <h4>Rabu</h4>
                        <p>Kec. Tegal Selatan</p>
                        <span>08:00 - 14:00 WIB</span>
                    </div>
                    <div class="schedule-card">
                        <h4>Kamis</h4>
                        <p>Kec. Margadana</p>
                        <span>08:00 - 14:00 WIB</span>
                    </div>
                </div>
            </div>
        </section>
        <section id="testimoni" class="testimonials">
            <div class="content-container">
                <div class="section-header" style="text-align: center; margin-bottom: 60px;">
                    <h2>Penilaian Layanan</h2>
                    <p>Apa kata mereka tentang pengalaman menggunakan layanan JEBOL.</p>
                </div>
                <style>
                    .premium-testimonials-grid {
                        display: grid;
                        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                        gap: 24px;
                        margin-top: 40px;
                    }
                    .premium-testi-card {
                        background: #ffffff;
                        border-radius: 24px;
                        padding: 30px;
                        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.05);
                        border: 1px solid rgba(0,0,0,0.02);
                        display: flex;
                        flex-direction: column;
                        transition: all 0.3s ease;
                        position: relative;
                        overflow: hidden;
                    }
                    .premium-testi-card:hover {
                        transform: translateY(-8px);
                        box-shadow: 0 20px 40px -15px rgba(0, 49, 120, 0.15);
                    }
                    .premium-testi-quote-icon {
                        position: absolute;
                        top: 20px;
                        right: 20px;
                        color: rgba(0, 49, 120, 0.05);
                        transform: scale(3);
                    }
                    .premium-testi-text {
                        font-size: 1rem;
                        color: #475569;
                        line-height: 1.6;
                        margin-bottom: 20px;
                        flex: 1;
                        font-style: italic;
                        position: relative;
                        z-index: 2;
                    }
                    .premium-testi-img {
                        width: 100%;
                        height: 160px;
                        object-fit: cover;
                        border-radius: 12px;
                        margin-bottom: 20px;
                        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
                        border: 1px solid #f1f5f9;
                    }
                    .premium-testi-user {
                        display: flex;
                        align-items: center;
                        gap: 12px;
                        margin-top: auto;
                        position: relative;
                        z-index: 2;
                    }
                    .premium-testi-avatar {
                        width: 44px;
                        height: 44px;
                        border-radius: 50%;
                        background: linear-gradient(135deg, var(--primary), var(--primary-light));
                        color: white;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-weight: 700;
                        font-size: 1.1rem;
                        box-shadow: 0 4px 10px rgba(0, 49, 120, 0.2);
                    }
                    .premium-testi-info h4 {
                        margin: 0 0 4px 0;
                        font-size: 1rem;
                        color: #0f172a;
                        font-weight: 700;
                    }
                    .premium-testi-stars {
                        display: flex;
                        gap: 2px;
                    }
                </style>
                <div class="premium-testimonials-grid">
                    @forelse($recentReviews as $review)
                        <div class="premium-testi-card">
                            <p class="premium-testi-text">"{{ Str::limit($review->kritik_saran, 120) }}"</p>
                            
                            @if($review->foto_path)
                                <img src="{{ Storage::url($review->foto_path) }}" alt="Foto Review" class="premium-testi-img">
                            @endif
                            
                            <div class="premium-testi-user">
                                <div class="premium-testi-avatar">
                                    {{ $review->masyarakat ? strtoupper(substr($review->masyarakat->name ?? $review->masyarakat->nama ?? 'A', 0, 1)) : 'A' }}
                                </div>
                                <div class="premium-testi-info">
                                    <h4>{{ $review->masyarakat ? ($review->masyarakat->name ?? $review->masyarakat->nama) : 'Anonim' }}</h4>
                                    <div class="premium-testi-stars">
                                        @for($i=1; $i<=5; $i++)
                                            <i data-lucide="star" width="14" height="14" style="stroke: {{ $i <= $review->nilai_kepuasan ? '#f59e0b' : '#cbd5e1' }}; fill: {{ $i <= $review->nilai_kepuasan ? '#f59e0b' : '#f8fafc' }};"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; padding: 60px 40px; color: var(--text-muted); background: white; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.02);">
                            <i data-lucide="message-square-dashed" style="width: 48px; height: 48px; color: #cbd5e1; margin-bottom: 16px; opacity: 0.5;"></i>
                            <p style="font-size: 1.1rem; margin: 0;">Belum ada ulasan dengan bintang 4 ke atas.<br>Jadilah yang pertama memberikan ulasan!</p>
                        </div>
                    @endforelse
                </div>
                <div style="text-align: center; margin-top: 48px;">
                    <a href="{{ route('ulasan') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 14px 32px; background: white; border: 2px solid var(--primary); color: var(--primary); font-weight: 800; border-radius: 100px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(0, 49, 120, 0.05);" onmouseover="this.style.background='var(--primary)'; this.style.color='white'; this.style.transform='translateY(-3px)'" onmouseout="this.style.background='white'; this.style.color='var(--primary)'; this.style.transform='translateY(0)'">
                        Lihat Selengkapnya <i data-lucide="arrow-right" width="18" height="18"></i>
                    </a>
                </div>
            </div>
        </section>

        <section id="faq" class="faq">
            <div class="content-container">
                <div class="section-header" style="text-align: center; margin-bottom: 60px;">
                    <h2>Pertanyaan Umum (FAQ)</h2>
                    <p>Punya pertanyaan? Mungkin jawabannya ada di sini.</p>
                </div>
                <div class="faq-list">
                    <div class="faq-item">
                        <div class="faq-question">
                            <h4>Apakah layanan JEBOL ini gratis?</h4>
                            <div class="faq-icon"><i data-lucide="plus"></i></div>
                        </div>
                        <div class="faq-answer">
                            <p>Ya, seluruh layanan kependudukan dan pencatatan sipil melalui JEBOL adalah 100% GRATIS tanpa dipungut biaya apapun.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <h4>Berapa lama proses pengerjaan dokumen?</h4>
                            <div class="faq-icon"><i data-lucide="plus"></i></div>
                        </div>
                        <div class="faq-answer">
                            <p>Rata-rata proses pengerjaan adalah 1-7 hari kerja tergantung jenis layanan dan kelengkapan berkas yang diunggah.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <h4>Dokumen apa saja yang bisa diantar/dijemput?</h4>
                            <div class="faq-icon"><i data-lucide="plus"></i></div>
                        </div>
                        <div class="faq-answer">
                            <p>Kami melayani jemput bola untuk perekaman KTP-el, serta pengantaran KTP-el, KIA, Kartu Keluarga, dan berbagai jenis Akta Pencatatan Sipil.</p>
                        </div>
                    </div>
                </div>
                <div style="text-align: center; margin-top: 40px;">
                    <a href="{{ route('bantuan') }}" class="btn-testimoni">
                        Pusat Bantuan <i data-lucide="arrow-right" width="18" height="18" style="margin-left: 8px;"></i>
                    </a>
                </div>
            </div>
        </section>

        <section id="lokasi" class="maps" style="padding-bottom: 0 !important;">
            <div class="content-container">
                <div class="section-header" style="text-align: center; margin-bottom: 60px;">
                    <h2>Lokasi Kantor Kami</h2>
                    <p>Kunjungi kantor pusat kami untuk konsultasi langsung.</p>
                </div>
            </div>
            <div class="maps-container">
                <div class="maps-info">
                    <div class="info-card">
                        <div class="info-icon"><i data-lucide="map-pin"></i></div>
                        <div>
                            <h4>Alamat Kantor</h4>
                            <p>Jl. Ki Gede Sebayu No.2, Tegal, Kec. Tegal Timur, Kota Tegal, Jawa Tengah 52123</p>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon"><i data-lucide="clock"></i></div>
                        <div>
                            <h4>Jam Operasional</h4>
                            <p>Senin - Kamis: 08.00 - 15.30 WIB<br>Jumat: 08.00 - 11.00 WIB</p>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon"><i data-lucide="phone"></i></div>
                        <div>
                            <h4>Kontak Kami</h4>
                            <p>Telp: (0283) 351001<br>WhatsApp: 0812-3456-7890</p>
                        </div>
                    </div>
                </div>
                <div class="maps-frame">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.036814214251!2d109.1352494109044!3d-6.886196293084307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb9d95f8e5611%3A0xc3f3458622c7d9e7!2sDisdukcapil%20Kota%20Tegal!5e0!3m2!1sid!2sid!4v1715484000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0; min-height: 450px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
        <section class="cta">
            <div class="cta-bg-elements"></div>
            <div class="content-container">
                <div class="cta-container">
                    <h2>Siap Mengurus Dokumen Anda?</h2>
                    <p>Daftarkan diri Anda sekarang dan nikmati layanan administrasi kependudukan tanpa harus keluar rumah melalui sistem JEBOL.</p>
                    <div class="cta-actions">
                        <a href="/register" class="btn btn-primary">Register Sekarang</a>
                        <a href="{{ route('bantuan') }}" class="btn btn-outline">Butuh Bantuan?</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('partials.footer')

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Header Scroll Effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (header) {
                if (window.scrollY > 50) {
                    header.style.boxShadow = '0 4px 6px -1px rgb(0 0 0 / 0.05)';
                } else {
                    header.style.boxShadow = 'none';
                }
            }
        });

        // Hero Slider Logic
        const slides = document.querySelectorAll('.slide');
        const prevBtn = document.querySelector('.slide-arrow.prev');
        const nextBtn = document.querySelector('.slide-arrow.next');
        let currentSlide = 0;
        const slideInterval = 60000; // 1 minute in milliseconds

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            slides[index].classList.add('active');
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        if (nextBtn && prevBtn) {
            nextBtn.addEventListener('click', nextSlide);
            prevBtn.addEventListener('click', prevSlide);
        }

        // Auto slide every 1 minute
        setInterval(nextSlide, slideInterval);

        // FAQ Accordion Logic
        document.querySelectorAll('.faq-question').forEach(button => {
            button.addEventListener('click', () => {
                const faqItem = button.parentElement;
                const isActive = faqItem.classList.contains('active');
                
                // Close all other items
                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                });

                // Toggle current item
                if (!isActive) {
                    faqItem.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>

