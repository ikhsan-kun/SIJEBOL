@extends('layouts.masyarakat')

@push('styles')
<style>
/* Background styling simplified */

        

        /* Main Content Styling */
        

        @media (max-width: 1024px) {
            
        }

        /* Bento Grid - Top */
        .dashboard-grid-top {
            display: grid;
            grid-template-columns: 2fr 1.1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1200px) {
            .dashboard-grid-top {
                grid-template-columns: 1fr;
            }
        }

        /* Spectacular Obsidian Hero Banner matched with Sidebar Brand Blue (#003178) */
        .hero-banner {
            background: linear-gradient(135deg, #003178 0%, #001230 100%);
            color: white;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.15);
            transition: all 0.3s ease;
        
            border-radius: 0;
            padding: 48px 96px;
            margin: 0 -48px 40px -48px;
            border-bottom: 4px solid var(--accent);
        }

        .hero-banner:hover {
            box-shadow: 0 25px 45px -10px rgba(15, 23, 42, 0.25);
        }

        /* Clean subtle highlight */
        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 60%;
            height: 100%;
            background: radial-gradient(circle at top right, rgba(56, 189, 248, 0.08) 0%, transparent 60%);
            pointer-events: none;
        }


        /* Elegant Greeting Line & Username */
        .hero-greeting-line {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 16px;
        }

        .hero-username {
            font-size: 1.15rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            letter-spacing: -0.2px;
        }

        .hero-username strong {
            color: #38bdf8; /* Cyan Highlight */
            font-weight: 800;
            text-transform: uppercase;
        }

        /* Sapaan Greeting Badge */
        .greeting-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(56, 189, 248, 0.12);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.25);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.82rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.1);
        }

        /* Majestic Brand Title (SI JEBOL) with Metallic Gradient */
        .hero-brand-title {
            font-size: 2.6rem;
            font-weight: 900;
            margin: 0 0 16px 0;
            letter-spacing: -2px;
            line-height: 1.05;
            background: linear-gradient(to right, #ffffff 40%, #a5f3fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            text-transform: uppercase;
        }

        .brand-badge {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #0f172a;
            padding: 6px 14px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 900;
            letter-spacing: 1px;
            box-shadow: 0 6px 15px rgba(245, 158, 11, 0.35);
            display: inline-block;
            vertical-align: middle;
            -webkit-text-fill-color: #0f172a; /* Fixes gradient clip transparency inheritance */
        }

        .hero-banner p {
            color: rgba(241, 245, 249, 0.75);
            font-size: 0.95rem;
            max-width: 540px;
            margin: 0 0 24px 0;
            font-weight: 400;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .hero-banner { padding: 36px; }
            .hero-user-name { font-size: 1.9rem; }
            .hero-banner p { font-size: 0.95rem; }
        }

        .hero-actions {
            display: flex;
            gap: 16px;
        }

        .btn-hero-primary {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #0f172a;
            padding: 12px 24px;
            border-radius: 16px;
            font-weight: 800;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.4), 0 0 0 1px rgba(251, 191, 36, 0.15);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
        }

        .btn-hero-primary:hover {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -5px rgba(217, 119, 6, 0.4);
        }

        .btn-hero-outline {
            background: rgba(255, 255, 255, 0.08);
            color: white;
            padding: 14px 28px;
            border-radius: 16px;
            font-weight: 700;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .btn-hero-outline:hover {
            background: rgba(255, 255, 255, 0.18);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        /* Clean Schedule Card */
        .schedule-card-v2 {
            background: white;
            border-radius: 20px;
            padding: 28px;
            display: flex;
            flex-direction: column;
            gap: 24px;
            border: 1px solid rgba(15, 23, 42, 0.04);
            box-shadow: 0 10px 25px -10px rgba(15, 23, 42, 0.03);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .schedule-card-v2:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px -10px rgba(15, 23, 42, 0.08);
            border-color: rgba(59, 130, 246, 0.15);
        }

        /* Glass Glowing Bubble Icon Container */
        .schedule-card-v2 .icon-box {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, #091a36 0%, #002d6e 100%);
            border-radius: 16px;
            display: grid;
            place-items: center;
            color: #38bdf8; /* Cyan Neon Glowing Icon */
            box-shadow: 0 8px 20px -4px rgba(0, 45, 110, 0.3), 0 0 12px rgba(56, 189, 248, 0.4);
            border: 1px solid rgba(56, 189, 248, 0.2);
            transition: all 0.3s ease;
        }

        .schedule-card-v2:hover .icon-box {
            transform: scale(1.08) rotate(5deg);
        }

        .schedule-card-v2 h3 {
            font-size: 1.45rem;
            font-weight: 800;
            margin: 0;
            color: #0f172a;
            letter-spacing: -0.5px;
        }

        /* Clean Time Box Layout */
        .schedule-time-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #f1f5f9;
        }

        /* Mini Calendar Pass Ticket block */
        .calendar-pass {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            width: 72px;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        }

        .calendar-pass-header {
            color: white;
            font-size: 0.62rem;
            font-weight: 800;
            text-transform: uppercase;
            padding: 4px 0;
            width: 100%;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .calendar-pass-

        .calendar-pass-day {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1;
        }

        .calendar-pass-month {
            font-size: 0.65rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            margin-top: 2px;
        }

        /* High-End Glassmorphic Chart Bento Card */
        .chart-card-v2 {
            background: white;
            border-radius: 24px;
            padding: 24px;
            border: 1px solid rgba(15, 23, 42, 0.04);
            box-shadow: 0 10px 25px -10px rgba(15, 23, 42, 0.03);
            display: flex;
            flex-direction: column;
            gap: 16px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-bottom: 24px;
        }

        .chart-card-v2:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px -10px rgba(15, 23, 42, 0.08);
            border-color: rgba(0, 49, 120, 0.15);
        }

        .card-header-v2 {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .card-title-v2 {
            font-size: 1rem;
            font-weight: 800;
            margin: 0;
            color: #0f172a;
            letter-spacing: -0.3px;
        }

        .card-subtitle-v2 {
            font-size: 0.78rem;
            color: #64748b;
            margin: 4px 0 0;
            font-weight: 500;
        }

        .chart-indicator {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #ecfdf5;
            color: #10b981;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.68rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid rgba(16, 185, 129, 0.15);
        }

        .chart-indicator .indicator-dot {
            width: 6px;
            height: 6px;
            background: #10b981;
            border-radius: 50%;
            animation: pulseActive 2s infinite;
        }

        @keyframes pulseActive {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.4); opacity: 0.4; }
            100% { transform: scale(1); opacity: 1; }
        }

        .chart-wrapper {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 180px;
        }

        .stats-grid-v2 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 28px;
            margin-bottom: 40px;
        }

        @media (max-width: 1200px) {
            .stats-grid-v2 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .stats-grid-v2 {
                grid-template-columns: 1fr;
            }
        }

        .stat-card-mini {
            background: white;
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 10px 25px -10px rgba(15, 23, 42, 0.03);
            border: 1px solid rgba(15, 23, 42, 0.04);
            display: flex;
            flex-direction: column;
            gap: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card-mini::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: transparent;
            transition: all 0.3s ease;
        }

        .stat-card-mini:hover {
            transform: translateY(-6px);
        }

        .stat-blue-hover:hover {
            box-shadow: 0 20px 30px -10px rgba(0, 49, 120, 0.2);
            border-color: rgba(0, 49, 120, 0.25);
        }
        .stat-blue-hover:hover::after { background: #003178; }

        .stat-orange-hover:hover {
            box-shadow: 0 20px 30px -10px rgba(249, 115, 22, 0.2);
            border-color: rgba(249, 115, 22, 0.25);
        }
        .stat-orange-hover:hover::after { background: #f97316; }

        .stat-green-hover:hover {
            box-shadow: 0 20px 30px -10px rgba(16, 185, 129, 0.2);
            border-color: rgba(16, 185, 129, 0.25);
        }
        .stat-green-hover:hover::after { background: #10b981; }

        .stat-card-mini .icon-sm {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: grid;
            place-items: center;
        }

        .icon-blue-bg { background: rgba(0, 49, 120, 0.08); color: #003178; }
        .icon-orange-bg { background: #fff7ed; color: #f97316; }
        .icon-green-bg { background: #ecfdf5; color: #10b981; }

        .stat-card-mini .label-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .stat-card-mini .label-text {
            color: #64748b;
            font-size: 0.82rem;
            font-weight: 700;
            margin: 0;
        }

        .stat-card-mini .stat-val {
            font-size: 2.2rem;
            font-weight: 800;
            line-height: 1;
            color: #0f172a;
            letter-spacing: -1px;
            margin-bottom: 8px;
        }
        
        .stat-card-mini .stat-subtext {
            font-size: 0.72rem;
            color: #94a3b8;
            font-weight: 600;
        }

        /* Clean CTA Card */
        .stat-card-cta {
            background: linear-gradient(135deg, #003178 0%, #001230 100%);
            border-radius: 24px;
            padding: 28px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            box-shadow: 0 10px 25px -10px rgba(0, 49, 120, 0.3);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stat-card-cta:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 45px -10px rgba(30, 27, 75, 0.55);
            border-color: rgba(245, 158, 11, 0.35);
        }

        .stat-card-cta h4 { 
            color: rgba(255,255,255,0.9); 
            font-size: 0.85rem; 
            font-weight: 700; 
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 0 8px; 
        }
        
        .stat-card-cta .cta-val { 
            font-size: 2.8rem; 
            font-weight: 800; 
            line-height: 1; 
            letter-spacing: -1.2px;
        }
        
        .stat-card-cta .cta-icon-box {
            background: rgba(255, 255, 255, 0.08); 
            padding: 12px; 
            border-radius: 14px; 
            margin-left: 16px; 
            flex-shrink: 0; 
            align-self: flex-start;
            border: 1px solid rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(5px);
            color: #fbbf24; /* Gold Star Accent */
        }

        /* Bottom Section Layout */
        .dashboard-grid-bottom {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 36px;
        }

        @media (max-width: 1024px) {
            .dashboard-grid-bottom {
                grid-template-columns: 1fr;
            }
        }

        .table-panel {
            background: white;
            border-radius: 2rem;
            padding: 36px;
            box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);
            border: 1px solid rgba(15, 23, 42, 0.04);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .panel-header h2 { 
            font-size: 1.42rem; 
            font-weight: 800; 
            margin: 0; 
            color: #0f172a; 
            letter-spacing: -0.6px;
        }
        
        .panel-header .view-all { 
            color: #3b82f6; 
            font-weight: 700; 
            font-size: 0.9rem; 
            text-decoration: none; 
            display: flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s ease;
        }

        .panel-header .view-all:hover {
            color: #1d4ed8;
            transform: translateX(3px);
        }

        /* Tables & Ledger */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th {
            text-align: left;
            padding: 16px 20px;
            color: #64748b;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            border-bottom: 1px solid #f1f5f9;
            background-color: #f8fafc;
        }

        .custom-table th:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .custom-table th:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .custom-table td {
            padding: 20px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.92rem;
            vertical-align: middle;
            transition: all 0.2s ease;
        }

        .custom-table tr {
            transition: all 0.2s ease;
        }

        .custom-table tr:hover td {
            background-color: #f8fafc;
        }

        .custom-table tr:last-child td {
            border-bottom: none;
        }

        .service-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .service-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .custom-table tr:hover .service-icon-box {
            transform: scale(1.08);
        }

        .icon-ktp-theme { background: #eff6ff; color: #2563eb; }
        .icon-kia-theme { background: #fff1f2; color: #f43f5e; }
        .icon-ikd-theme { background: #faf5ff; color: #8b5cf6; }
        .icon-other-theme { background: #f8fafc; color: #64748b; }

        .status-badge-v2 {
            padding: 6px 14px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-badge-v2::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: currentColor;
            display: inline-block;
            box-shadow: 0 0 6px currentColor;
        }

        .status-verif { background: #fff4e5; color: #b76400; border: 1px solid rgba(183, 100, 0, 0.12); }
        .status-jadwal { background: #eff6ff; color: #1d4ed8; border: 1px solid rgba(29, 78, 216, 0.12); }
        .status-selesai { background: #e2fbf0; color: #107c41; border: 1px solid rgba(16, 124, 65, 0.12); }

        .action-row-btn {
            background: #f8fafc; 
            border: 1px solid #e2e8f0; 
            color: #64748b; 
            cursor: pointer;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            transition: all 0.2s ease;
        }

        .action-row-btn:hover {
            background: #eff6ff;
            color: #3b82f6;
            border-color: #bfdbfe;
            transform: scale(1.05);
        }

        /* Quick Actions */
        .quick-actions-panel {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .action-card-v2 {
            background: white;
            border-radius: 20px;
            padding: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(15, 23, 42, 0.03);
            box-shadow: 0 4px 15px rgba(0,0,0,0.01);
        }

        .action-card-v2:hover {
            transform: translateX(8px) translateY(-1px);
            border-color: #3b82f6;
            box-shadow: 0 10px 20px -8px rgba(59, 130, 246, 0.15);
        }

        .action-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .action-icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            background: #f8fbff;
            display: grid;
            place-items: center;
            color: #3b82f6;
            box-shadow: inset 0 2px 4px rgba(59, 130, 246, 0.05);
            transition: all 0.3s ease;
        }

        .action-card-v2:hover .action-icon {
            background: #3b82f6;
            color: white;
        }

        .action-info h5 { margin: 0; font-size: 0.98rem; font-weight: 800; color: #002254; }
        .action-info p { margin: 3px 0 0; font-size: 0.8rem; color: #64748b; }

        .promo-card {
            background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%, #e0e7ff 100%);
            border-radius: 24px;
            padding: 28px;
            margin-top: 16px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(99, 102, 241, 0.15);
            box-shadow: 0 15px 30px -10px rgba(99, 102, 241, 0.2);
        }

        .promo-card h6 { 
            color: #4f46e5; 
            font-size: 0.72rem; 
            font-weight: 800; 
            text-transform: uppercase; 
            letter-spacing: 1px;
            margin: 0 0 8px; 
        }
        
        .promo-card h4 { 
            font-size: 1.2rem; 
            font-weight: 800; 
            color: #002254; 
            margin: 0 0 12px; 
            letter-spacing: -0.5px;
        }
        
        .promo-card p { 
            font-size: 0.88rem; 
            color: #475569; 
            line-height: 1.6; 
            margin: 0;
        }

        .promo-truck-bg {
            position: absolute; 
            bottom: -20px; 
            right: -10px; 
            opacity: 0.08;
            color: #4f46e5;
            pointer-events: none;
        }

        /* Table Responsiveness */
        @media (max-width: 768px) {
            .table-panel { padding: 20px; }
            .desktop-table-view { display: none !important; }
            .mobile-card-view { display: flex !important; flex-direction: column; gap: 16px; margin-top: 8px; }
        }
        @media (min-width: 769px) {
            .desktop-table-view { display: block !important; }
            .mobile-card-view { display: none !important; }
        }

        .mobile-card {
            background: white;
            border: 1px solid #f1f5f9;
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .mobile-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .mobile-card-service {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .mobile-card-title {
            font-weight: 800;
            color: #1e293b;
            font-size: 0.95rem;
            margin: 0;
        }

        .mobile-card-subtitle {
            font-size: 0.75rem;
            color: #64748b;
            margin: 2px 0 0;
            font-family: monospace;
        }

        .mobile-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            border-top: 1px solid #f8fafc;
            padding-top: 12px;
        }

        .mobile-btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: #eff6ff;
            color: #2563eb;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
        }

        .mobile-btn-detail:hover {
            background: #2563eb;
            color: white;
        }
</style>
@endpush

@section('content')
<!-- Hero & Schedule Section -->
            <div class="dashboard-grid-top">
                <div class="hero-banner">
                    
                    <div class="jbl-1109 jbl-354">
                        <!-- Elegant Greeting Line with Badge & Username -->
                        <div class="hero-greeting-line">
                            <div class="greeting-badge">
                                @if($hour >= 5 && $hour < 11)
                                    <i data-lucide="sunrise" style="width: 14px; height: 14px;"></i>
                                @elseif($hour >= 11 && $hour < 15)
                                    <i data-lucide="sun" style="width: 14px; height: 14px;"></i>
                                @elseif($hour >= 15 && $hour < 18)
                                    <i data-lucide="sunset" style="width: 14px; height: 14px;"></i>
                                @else
                                    <i data-lucide="moon" style="width: 14px; height: 14px;"></i>
                                @endif
                                <span>{{ $greeting }},</span>
                            </div>
                            <span class="hero-username">Selamat Datang, <strong>{{ auth()->user()->name }}</strong></span>
                        </div>
                        
                        <!-- Brand Signature tag with Gold Pill - Massive Title Focus! -->
                        <h1 class="hero-brand-title">
                            <span>SI JEBOL</span>
                            <span class="brand-badge">KECAMATAN</span>
                        </h1>
                        
                        <p>Selamat datang di gerbang pelayanan adminduk mandiri Kota Tegal. Pantau permohonan warga dan ajukan kegiatan jemput bola secara terintegrasi.</p>
                        
                        <div class="hero-actions">
                            <a href="{{ route('masyarakat.kecamatan.ajukan') }}" class="btn-hero-primary">
                                <span class="material-symbols-outlined">add_circle</span>
                                <span>Ajukan Kegiatan JEBOL</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="schedule-card-v2">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div class="icon-box">
                            <i data-lucide="building"></i>
                        </div>
                    </div>
                    
                    <div style="margin-top: 4px;">
                        <h3 style="font-size: 1.45rem; font-weight: 800; color: #0f172a; margin-bottom: 6px;">
                            Jadwal JEBOL Mendatang
                        </h3>
                        <p style="color: #64748b; font-size: 0.85rem; font-weight: 600; margin: 0; display: inline-flex; align-items: center; gap: 6px; background: rgba(255, 255, 255, 0.4); border: 1px solid rgba(59, 130, 246, 0.1); padding: 4px 10px; border-radius: 8px;">
                            Belum ada jadwal pelayanan terdekat di wilayah Anda.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="stats-grid-v2">
                <div class="stat-card-mini stat-blue-hover">
                    <div class="label-row">
                        <p class="label-text">Total Warga Terdaftar</p>
                        <div class="icon-sm icon-blue-bg"><i data-lucide="users"></i></div>
                    </div>
                    <div class="stat-val">{{ str_pad($totalWarga ?? 0, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="stat-subtext">Akun Aktif</div>
                </div>

                <div class="stat-card-mini stat-orange-hover">
                    <div class="label-row">
                        <p class="label-text">Pengajuan JEBOL</p>
                        <div class="icon-sm icon-orange-bg"><i data-lucide="file-text"></i></div>
                    </div>
                    <div class="stat-val">{{ str_pad($totalPengajuan ?? 0, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="stat-subtext">Total Pengajuan</div>
                </div>

                <div class="stat-card-mini stat-green-hover">
                    <div class="label-row">
                        <p class="label-text">Sedang Diproses</p>
                        <div class="icon-sm icon-green-bg"><i data-lucide="refresh-cw"></i></div>
                    </div>
                    <div class="stat-val">{{ str_pad($pengajuanAktif ?? 0, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="stat-subtext">Oleh Disdukcapil</div>
                </div>
            </div>

            <!-- Bottom Table Section -->
            <div class="dashboard-grid-bottom">
                <div class="table-panel">
                    <div class="panel-header">
                        <h2>Kegiatan JEBOL Terakhir</h2>
                        <a href="#" class="view-all">Lihat Semua <i data-lucide="arrow-up-right" style="width: 16px; height: 16px;"></i></a>
                    </div>
                    <p style="color: #64748b; font-size: 0.85rem; margin: -16px 0 24px; font-weight: 500;">Pantau kegiatan jemput bola di wilayah Anda.</p>

                    <!-- Desktop Table View -->
                    <div class="desktop-table-view">
                        <table class="custom-table jbl-1539">
                            <thead>
                                <tr>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Lokasi / Keterangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 48px; color: #64748b; font-style: italic; font-weight: 500;">Belum ada riwayat pengajuan kegiatan JEBOL dari Kecamatan ini.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="mobile-card-view">
                        <div style="text-align: center; padding: 40px 20px; color: #94a3b8; font-size: 0.85rem; border: 1px dashed #cbd5e1; border-radius: 16px;">
                            Belum ada riwayat pengajuan kegiatan JEBOL.
                        </div>
                    </div>
                </div>

                <div class="quick-actions-panel">
                    <h3 style="font-size: 1.2rem; font-weight: 800; margin: 0 0 4px; color: #0f172a; letter-spacing: -0.5px;">Menu Kecamatan</h3>
                    <p style="color: #64748b; font-size: 0.82rem; margin: 0 0 18px; font-weight: 500;">Kelola data dan permohonan</p>
                    
                    <a href="{{ route('masyarakat.kecamatan.ajukan') }}" class="action-card-v2">
                        <div class="action-content">
                            <div class="action-icon"><i data-lucide="building"></i></div>
                            <div class="action-info">
                                <h5>Ajukan JEBOL</h5>
                                <p>Buat permohonan kunjungan</p>
                            </div>
                        </div>
                        <i data-lucide="chevron-right" style="width: 18px; color: #94a3b8;"></i>
                    </a>

                    <a href="{{ route('masyarakat.kecamatan.monitoring') }}" class="action-card-v2">
                        <div class="action-content">
                            <div class="action-icon"><i data-lucide="users"></i></div>
                            <div class="action-info">
                                <h5>Data Warga</h5>
                                <p>Monitoring permohonan warga</p>
                            </div>
                        </div>
                        <i data-lucide="chevron-right" style="width: 18px; color: #94a3b8;"></i>
                    </a>

                    <a href="{{ route('masyarakat.kecamatan.jadwal') }}" class="action-card-v2">
                        <div class="action-content">
                            <div class="action-icon"><i data-lucide="calendar"></i></div>
                            <div class="action-info">
                                <h5>Jadwal Pelayanan</h5>
                                <p>Informasi layanan terdekat</p>
                            </div>
                        </div>
                        <i data-lucide="chevron-right" style="width: 18px; color: #94a3b8;"></i>
                    </a>

                    <div class="promo-card">
                        <h6>LAYANAN KHUSUS</h6>
                        <h4>Koordinasi Disdukcapil</h4>
                        <p>Kecamatan dapat mengajukan layanan khusus untuk warga lansia, disabilitas, dan kegiatan massal desa/kelurahan.</p>

                        <div class="promo-truck-bg">
                            <i data-lucide="briefcase" style="width: 90px; height: 90px;"></i>
                        </div>
                    </div>
                </div>
            </div>
@endsection
