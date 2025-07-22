<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NatSave AML | Advanced Learning Management System</title>

    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')

    <style>
        .font-Montserrat { font-family: 'Montserrat', sans-serif; }
        .hero-gradient { background: linear-gradient(135deg, #065f46 0%, #047857 50%, #059669 100%); }
        .feature-card { transition: all 0.3s ease; transform: translateY(0); }
        .feature-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .pulse-glow { animation: pulse-glow 2s infinite; }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(5, 150, 105, 0.3); }
            50% { box-shadow: 0 0 30px rgba(5, 150, 105, 0.6); }
        }
        .typewriter { border-right: 2px solid #059669; animation: blink 1s infinite; }
        @keyframes blink { 0%, 50% { border-color: #059669; } 51%, 100% { border-color: transparent; } }
        .scroll-reveal { opacity: 0; transform: translateY(30px); transition: all 0.6s ease; }
        .scroll-reveal.revealed { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation Header -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('imgs/natsave.png') }}" class="h-12 md:h-14" alt="NatSave Logo">
                    <div class="bg-green-800 font-semibold text-xs md:text-sm pl-3 pr-6 py-2 text-white rounded-tr-full rounded-br-full">
                        Advanced Learning Platform
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#features" class="hidden md:block text-gray-700 hover:text-green-800 font-medium transition-colors">Features</a>
                    <a href="#about" class="hidden md:block text-gray-700 hover:text-green-800 font-medium transition-colors">About</a>
                    <a href="/course/login" class="bg-green-800 hover:bg-green-900 text-white px-6 py-3 rounded-full font-semibold transition-all duration-300 pulse-glow">
                        Get Started | Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
        <img src="{{ asset('imgs/bg.svg') }}" class="absolute inset-0 w-full h-full object-cover" alt="Background">
        <div class="absolute inset-0 hero-gradient opacity-90"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left">
                    <h1 class="font-Montserrat text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-8 leading-tight">
                        Empower Your Team with
                        <span class="text-yellow-300">Advanced AML Training</span>
                    </h1>

                    <div class="mb-8 text-white/90 text-xl md:text-2xl font-medium h-20">
                        <span class="font-extrabold text-yellow-300">"</span>
                        <span id="quote" class="typewriter"></span>
                        <span class="font-extrabold text-yellow-300">"</span>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mb-12">
                        <a href="/course/login" class="bg-yellow-500 hover:bg-yellow-400 text-gray-900 px-8 py-4 rounded-full font-bold text-lg transition-all duration-300 transform hover:scale-105">
                            Start Learning Now
                        </a>
                        <a href="#features" class="border-2 border-white text-white hover:bg-white hover:text-green-800 px-8 py-4 rounded-full font-bold text-lg transition-all duration-300">
                            Explore Features
                        </a>
                    </div>

                    <div class="flex items-center justify-center lg:justify-start space-x-3 text-white/80">
                        <span class="text-sm font-semibold">Powered By</span>
                        <img src="{{ asset('imgs/logo_small.png') }}" class="h-10" alt="Ontech Logo">
                        <span class="text-sm font-medium">Ontech Solutions</span>
                    </div>
                </div>

                <div class="relative">
                    <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 border border-white/20">
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-green-600 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-white">309+</div>
                                <div class="text-sm text-green-100">Active Users</div>
                            </div>
                            <div class="bg-yellow-500 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-gray-900">Unlimited</div>
                                <div class="text-sm text-gray-800">Training Modules</div>
                            </div>
                            <div class="bg-blue-600 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-white">100%</div>
                                <div class="text-sm text-blue-100">Compliance</div>
                            </div>
                            <div class="bg-purple-600 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-white">24/7</div>
                                <div class="text-sm text-purple-100">Monitoring</div>
                            </div>
                        </div>
                        <div class="text-center text-white">
                            <div class="text-sm opacity-80">Real-time Progress Tracking</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="font-Montserrat text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Comprehensive Learning <span class="text-green-800">Features</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Our advanced platform provides everything you need for effective AML compliance training and monitoring
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Cards -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100 scroll-reveal">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Real-time Analytics</h3>
                    <p class="text-gray-600 mb-4">Comprehensive dashboards with live user activity tracking, progress monitoring, and detailed performance analytics.</p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li>• User engagement metrics</li>
                        <li>• Progress percentages</li>
                        <li>• Activity timestamps</li>
                    </ul>
                </div>

                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100 scroll-reveal">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Interactive Learning</h3>
                    <p class="text-gray-600 mb-4">Engaging modules with video content, document resources, and interactive quizzes for effective knowledge retention.</p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li>• Video progress tracking</li>
                        <li>• Document downloads</li>
                        <li>• Interactive assessments</li>
                    </ul>
                </div>

                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100 scroll-reveal">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-purple-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Smart Assessment</h3>
                    <p class="text-gray-600 mb-4">Advanced quiz system with automated scoring, detailed feedback, and comprehensive attempt history tracking.</p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li>• Automated marking</li>
                        <li>• Detailed scoring</li>
                        <li>• Attempt history</li>
                    </ul>
                </div>

                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100 scroll-reveal">
                    <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-yellow-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2v0a2 2 0 01-2-2v-2a2 2 0 00-2-2H8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Advanced Reporting</h3>
                    <p class="text-gray-600 mb-4">Comprehensive PDF reports with detailed analytics, user activity summaries, and compliance documentation.</p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li>• PDF export capabilities</li>
                        <li>• Compliance reports</li>
                        <li>• Activity summaries</li>
                    </ul>
                </div>

                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100 scroll-reveal">
                    <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Security & Compliance</h3>
                    <p class="text-gray-600 mb-4">Enterprise-grade security with detailed audit trails, IP tracking, and comprehensive compliance monitoring.</p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li>• Audit trail logging</li>
                        <li>• IP address tracking</li>
                        <li>• Session monitoring</li>
                    </ul>
                </div>

                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100 scroll-reveal">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Real-time Monitoring</h3>
                    <p class="text-gray-600 mb-4">Live activity monitoring with auto-refresh dashboards, instant notifications, and real-time progress updates.</p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li>• Live activity feeds</li>
                        <li>• Auto-refresh dashboards</li>
                        <li>• Instant notifications</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Partner Section -->
    <section id="about" class="py-20 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="scroll-reveal">
                    <h2 class="font-Montserrat text-4xl md:text-5xl font-bold text-white mb-8">
                        Powered by <span class="text-green-400">Innovation</span>
                    </h2>
                    <p class="text-xl text-gray-300 mb-8">
                        Built by Zambia's leading technology solutions provider, delivering enterprise-grade learning management systems with cutting-edge features and unmatched reliability.
                    </p>
                    <div class="space-y-4 text-gray-300">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Enterprise-grade security and compliance</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>24/7 technical support and maintenance</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Continuous platform updates and improvements</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 backdrop-blur-sm rounded-3xl p-8 border border-white/10 scroll-reveal">
                    <div class="flex items-center space-x-4 mb-6">
                        <img src="{{ asset('imgs/logo_small.png') }}" class="h-16" alt="Ontech Logo">
                        <div>
                            <h3 class="text-2xl font-bold text-white">Ontech Solutions Limited</h3>
                            <p class="text-green-400">Technology Partner</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-gray-300">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p>Plot No. 25996, Kwacha Road</p>
                                <p>Olympia Park, Lusaka, Zambia</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>+260 211 432 400</span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>info@ontech.co.zm</span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0-9a9 9 0 019 9m-9-9a9 9 0 00-9 9"></path>
                            </svg>
                            <span>www.ontech.co.zm</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-green-800 to-green-600">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8 scroll-reveal">
            <h2 class="font-Montserrat text-4xl md:text-5xl font-bold text-white mb-6">
                Ready to Transform Your Training?
            </h2>
            <p class="text-xl text-green-100 mb-10">
                Join hundreds of professionals already advancing their AML compliance knowledge with our comprehensive platform.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/course/login" class="bg-yellow-500 hover:bg-yellow-400 text-gray-900 px-10 py-4 rounded-full font-bold text-lg transition-all duration-300 transform hover:scale-105">
                    Start Your Journey Today
                </a>
                <a href="mailto:info@ontech.co.zm" class="border-2 border-white text-white hover:bg-white hover:text-green-800 px-10 py-4 rounded-full font-bold text-lg transition-all duration-300">
                    Contact Support
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <img src="{{ asset('imgs/natsave.png') }}" class="h-12 mb-4" alt="NatSave Logo">
                    <p class="text-gray-400">Advanced AML training and compliance management platform for financial institutions.</p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Quick Links</h4>
                    <div class="space-y-2">
                        <a href="/course/login" class="block text-gray-400 hover:text-white transition-colors">Login</a>
                        <a href="#features" class="block text-gray-400 hover:text-white transition-colors">Features</a>
                        <a href="#about" class="block text-gray-400 hover:text-white transition-colors">About</a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Technology Partner</h4>
                    <div class="flex items-center space-x-3 mb-2">
                        <img src="{{ asset('imgs/logo_small.png') }}" class="h-8" alt="Ontech Logo">
                        <span class="text-white">Ontech Solutions</span>
                    </div>
                    <p class="text-gray-400 text-sm">Olympia Park, Lusaka, Zambia</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} NatSave AML Learning Platform. Powered by Ontech Solutions Limited.</p>
            </div>
        </div>
    </footer>

    <script>
        // Typewriter Effect
        const quotes = [
            "Monitoring transactions helps detect suspicious activities in real-time.",
            "Comprehensive AML training ensures regulatory compliance excellence.",
            "Advanced analytics provide insights into user learning patterns.",
            "Real-time tracking enhances training effectiveness and engagement.",
            "Smart assessment tools deliver accurate performance evaluations."
        ];

        let currentQuote = 0;
        let currentChar = 0;
        let isDeleting = false;

        function typeWriter() {
            const quote = quotes[currentQuote];
            const quoteElement = document.getElementById('quote');

            if (isDeleting) {
                quoteElement.textContent = quote.substring(0, currentChar - 1);
                currentChar--;

                if (currentChar === 0) {
                    isDeleting = false;
                    currentQuote = (currentQuote + 1) % quotes.length;
                    setTimeout(typeWriter, 500);
                    return;
                }
            } else {
                quoteElement.textContent = quote.substring(0, currentChar + 1);
                currentChar++;

                if (currentChar === quote.length) {
                    setTimeout(() => {
                        isDeleting = true;
                        typeWriter();
                    }, 2000);
                    return;
                }
            }

            setTimeout(typeWriter, isDeleting ? 50 : 100);
        }

        // Scroll reveal animation
        function revealOnScroll() {
            const reveals = document.querySelectorAll('.scroll-reveal');

            reveals.forEach(element => {
                const windowHeight = window.innerHeight;
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;

                if (elementTop < windowHeight - elementVisible) {
                    element.classList.add('revealed');
                }
            });
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Initialize
        window.addEventListener('load', () => {
            typeWriter();
            revealOnScroll();
        });

        window.addEventListener('scroll', revealOnScroll);
    </script>
</body>
</html>
