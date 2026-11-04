/**
 * Vegesna Rohini Official Portal - Main Interactive Scripts (Apple-Inspired White Theme)
 */

// Bilingual Translation Dictionary
const translations = {
  en: {
    // Navigation
    nav_home: "Overview",
    nav_about: "About",
    nav_vision: "Vision & Pillars",
    nav_social: "Social Hub",
    nav_academia: "Academia & AI",
    nav_media: "Media & Press",
    nav_grievance: "Praja Vani",
    cta_grievance: "Submit Grievance",

    // Banner & Hero
    hero_eyebrow: "ACADEMICIAN • CIVIC LEADER • BHIMAVARAM",
    hero_title: "Vegesna Rama Bangaru Rohini",
    hero_slogan: "Swachh Bhimavaram. Swarna Bhimavaram.",
    hero_desc: "Blending higher academic excellence with grassroots public service. Working hand-in-hand with citizens, youth, and women to build a prosperous, clean, and forward-looking Bhimavaram.",
    hero_stat_followers: "Engaged Citizens",
    hero_stat_wards: "Municipal Wards",
    hero_stat_papers: "AI / Tech Publications",
    hero_stat_service: "Grassroots Dedication",
    btn_explore_vision: "Explore 6 Pillars",
    btn_follow_ig: "Follow on Instagram",
    btn_follow_fb: "Follow on Facebook",

    // About Section
    about_badge: "LEADERSHIP & VALUES",
    about_title: "About Vegesna Rohini",
    about_subtitle: "An educator's vision and a public servant's heart for Bhimavaram's future.",
    about_p1: "Vegesna Rama Bangaru Rohini stands at the intersection of modern academic intellect and grassroots civic leadership. As an Assistant Professor at the prestigious SRKR Engineering College in Bhimavaram, she has mentored hundreds of aspiring engineers and contributed pioneering research in Artificial Intelligence, Vision Transformers, and Blockchain governance.",
    about_p2: "Inspired by the ethos of Deputy Chief Minister Pawan Kalyan and the Jana Sena Party alliance, she entered public life to champion clean, transparent, and responsive municipal administration. She carries forward the noble legacy of public welfare established by her father, senior leader and Kshatriya Corporation Chairman Vegesna Kanaka Raju Suri.",
    about_pill_1: "SRKR Engineering College Faculty",
    about_pill_2: "Municipal Chairperson Contender",
    about_pill_3: "Grassroots Civic Worker",
    about_pill_4: "Youth & Women Mentor",

    // Vision Section
    vision_badge: "STRATEGIC ROADMAP",
    vision_title: "Vision: Swachh & Swarna Bhimavaram",
    vision_subtitle: "6 Core Pillars for Transforming Bhimavaram into a Model Municipal Town",
    pillar_1_title: "1. Clean & Green Bhimavaram",
    pillar_1_desc: "Door-to-door segregated waste collection, desilting of major drainage canals, mechanized cleaning, and plastic-free ward initiatives.",
    pillar_2_title: "2. Flood Mitigation & Underground Drainage",
    pillar_2_desc: "Modernizing urban runoff canals and upgrading underground sewer lines to put an end to monsoon waterlogging once and for all.",
    pillar_3_title: "3. 24/7 Safe Potable Water",
    pillar_3_desc: "Automated filtration plants, regular pipeline testing, and reliable piped drinking water supply to every household across all 39 wards.",
    pillar_4_title: "4. Youth & Women Empowerment",
    pillar_4_desc: "Modern digital skill incubators, support for DWCRA women self-help groups, entrepreneurship loans, and competitive exam coaching centers.",
    pillar_5_title: "5. Transparent & Corruption-Free Governance",
    pillar_5_desc: "Digital citizen service counters, transparent municipal clearances, and strict accountability for public grievance resolution.",
    pillar_6_title: "6. World-Class Municipal Infrastructure",
    pillar_6_desc: "Pothole-free arterial roads, energy-efficient LED street lighting in every lane, green public parks, and upgraded municipal school facilities.",

    // Academia & Research Section
    acad_badge: "SCHOLARLY EXCELLENCE",
    acad_title: "Academic & AI Research Portfolio",
    acad_subtitle: "Assistant Professor, Dept of IT / Engineering — SRKR Engineering College",
    acad_desc: "Combining technical innovation with public problem solving. Her research papers explore how cutting-edge computer vision, deep learning, and decentralized blockchain systems can serve societal needs.",
    paper_1_title: "Automated Detection of Eye Coloboma using Vision Transformers and Explainable AI Techniques",
    paper_1_venue: "IEEE International Conference on Computing, Communication and Automation (ICCCA)",
    paper_1_desc: "Proposes an Explainable AI (XAI) deep learning pipeline with Vision Transformers to assist ophthalmologists with high-confidence pediatric eye defect diagnoses.",
    paper_2_title: "SenT-In: A Deep Sentiment-Aware Transformer Model for High-Precision Stock Trend Analysis",
    paper_2_venue: "IEEE International Conference on Computing, Power, and Communication Technologies (IC2PCT)",
    paper_2_desc: "Architects a hybrid financial sentiment transformer to process temporal macroeconomic trends with quantitative reliability.",
    paper_3_title: "Decentralized Blockchain-Based Voting System with AI-ML Behavioral Analysis",
    paper_3_venue: "IEEE Conference Proceedings",
    paper_3_desc: "Surveys tamper-evident cryptographic voting frameworks augmented with anomaly detection to protect electoral integrity and citizen privacy.",

    // Social Section
    social_badge: "OFFICIAL CHANNELS",
    social_title: "Official Social Media Hub",
    social_subtitle: "Stay updated directly through verified Instagram and Facebook handles",
    social_ig_handle: "@vegesnarohini.official",
    social_ig_title: "Instagram Official",
    social_ig_desc: "Follow daily reels, field inspections, public meetings, and student interactions.",
    social_fb_title: "Facebook Official Page",
    social_fb_handle: "Vegesna Rohini (Digital Creator / Public Figure)",
    social_fb_desc: "Detailed press statements, ward announcements, public addresses, and community dialogues.",

    // Media & Press Section
    media_badge: "PRESS & SPEECHES",
    media_title: "Media Coverage & Public Addresses",
    media_subtitle: "Watch key interviews, press conferences, and public addresses",

    // Praja Vani (Grievances) Section
    grievance_badge: "CITIZEN GRIEVANCE PORTAL",
    grievance_title: "Praja Vani — Citizen Voice & Redressal",
    grievance_subtitle: "Submit issues regarding sanitation, drinking water, streetlights, or drainage directly to Rohini's office.",
    form_name_label: "Your Full Name *",
    form_phone_label: "Mobile / WhatsApp Number *",
    form_ward_label: "Select Municipal Ward *",
    form_locality_label: "Colony / Street / Landmark",
    form_category_label: "Grievance Category *",
    form_desc_label: "Describe the Issue in Detail *",
    form_priority_label: "Urgency Level",
    form_submit_btn: "Submit Grievance to Office",
    track_title: "Already submitted a grievance? Track Status:",
    track_placeholder: "Enter Tracking ID (e.g., VR-BV-8402)",
    track_btn: "Check Status"
  },

  te: {
    // Navigation
    nav_home: "ఓవర్‌వ్యూ",
    nav_about: "పరిచయం",
    nav_vision: "లక్ష్యం & సిద్ధాంతం",
    nav_social: "సోషల్ మీడియా",
    nav_academia: "పరిశోధనలు & విద్య",
    nav_media: "వార్తలు & ప్రెస్",
    nav_grievance: "ప్రజావాణి",
    cta_grievance: "సమస్య నమోదు చేయండి",

    // Banner & Hero
    hero_eyebrow: "విద్యావేత్త • ప్రజా నాయకురాలు • భీమవరం",
    hero_title: "వేగేశ్న రమా బంగారు రోహిణి",
    hero_slogan: "స్వచ్ఛ భీమవరం. స్వర్ణ భీమవరం.",
    hero_desc: "ఉన్నత విద్యా నేపథ్యంతో ప్రజల సేవలోకి అడుగుపెట్టిన యువ నాయకత్వం. భీమవరం పట్టణాన్ని పరిశుభ్రమైన, అభివృద్ధి పథంలో నడిపించేందుకు జనసైనికులు, వీర మహిళలు, కూటమి శ్రేణులతో కలసి నిరంతర శ్రమ.",
    hero_stat_followers: "ఫాలోవర్లు & శ్రేయోభిలాషులు",
    hero_stat_wards: "మున్సిపల్ వార్డులు",
    hero_stat_papers: "AI / టెక్ పరిశోధనా పత్రాలు",
    hero_stat_service: "నిస్వార్థ ప్రజా సేవ",
    btn_explore_vision: "6 ప్రధాన స్తంభాలు",
    btn_follow_ig: "ఇన్‌స్టాగ్రామ్‌లో ఫాలో అవ్వండి",
    btn_follow_fb: "ఫేస్‌బుక్‌లో కలవండి",

    // About Section
    about_badge: "నాయకత్వం & వారసత్వం",
    about_title: "వేగేశ్న రోహిణి పరిచయం",
    about_subtitle: "భీమవరం సమగ్రాభివృద్ధి కోసం నిబద్ధతతో కూడిన యువ గళం.",
    about_p1: "వేగేశ్న రమా బంగారు రోహిణి గారు ఉన్నత విద్యావంతురాలిగా, భీమవరంలోని ప్రముఖ ఎస్.ఆర్.కె.ఆర్ (SRKR) ఇంజనీరింగ్ కళాశాలలో అసిస్టెంట్ ప్రొఫెసర్‌గా పనిచేస్తూ ఎందరో విద్యార్థుల భవిష్యత్తుకు మార్గదర్శనం చేశారు. ఆర్టిఫిషియల్ ఇంటెలిజెన్స్ (AI), డీప్ లెర్నింగ్, కంప్యూటర్ విజన్ మరియు బ్లాక్‌చెయిన్ రంగాలలో ప్రముఖ పరిశోధనా పత్రాలను అంతర్జాతీయ ఐ.ఈ.ఈ.ఈ (IEEE) జర్నల్స్‌లో ప్రచురించారు.",
    about_p2: "ఆంధ్రప్రదేశ్ ఉప ముఖ్యమంత్రి, జనసేన పార్టీ అధినేత పవన్ కళ్యాణ్ గారి ఆదర్శాలతో ప్రేరణ పొంది, ప్రజా సేవలోకి ప్రవేశించారు. సీనియర్ నాయకులు, క్షత్రియ కార్పొరేషన్ చైర్మన్ వేగేశ్న కనకరాజు సూరి గారి కుమార్తెగా వారి సేవా వారసత్వాన్ని కొనసాగిస్తూ, భీమవరం మున్సిపల్ చైర్‌పర్సన్ అభ్యర్థిగా ప్రజల సమస్యల పరిష్కారానికి అంకితభావంతో పనిచేస్తున్నారు.",
    about_pill_1: "ఎస్.ఆర్.కె.ఆర్ ఇంజనీరింగ్ కళాశాల అధ్యాపకురాలు",
    about_pill_2: "భీమవరం మున్సిపల్ చైర్‌పర్సన్ అభ్యర్థి",
    about_pill_3: "ప్రజా సంక్షేమ ఉద్యమకర్త",
    about_pill_4: "యువత & మహిళా సాధికారత మార్గదర్శి",

    // Vision Section
    vision_badge: "అభివృద్ధి ప్రణాళిక",
    vision_title: "లక్ష్యం: స్వచ్ఛ భీమవరం - స్వర్ణ భీమవరం",
    vision_subtitle: "భీమవరాన్ని ఆదర్శ మున్సిపాలిటీగా తీర్చిదిద్దే 6 ప్రధాన స్తంభాలు",
    pillar_1_title: "1. పరిశుభ్రమైన & పచ్చని భీమవరం",
    pillar_1_desc: "ఇంటింటికీ చెత్త సేకరణ, డ్రైనేజీ కాలువల నిరంతర పూడికతీత, యంత్రాలతో శుభ్రత, మరియు ప్లాస్టిక్ రహిత వార్డుల నిర్మాణం.",
    pillar_2_title: "2. వరద నివారణ & అండర్ గ్రౌండ్ డ్రైనేజీ",
    pillar_2_desc: "వర్షాకాలంలో పట్టణంలో నీరు నిలవకుండా వరద కాల్వల ఆధునీకరణ, నాణ్యమైన అండర్‌గ్రౌండ్ డ్రైనేజీ వ్యవస్థ ఏర్పాటు.",
    pillar_3_title: "3. 24 గంటల సురక్షిత త్రాగునీరు",
    pillar_3_desc: "ఆధునిక వాటర్ ఫిల్ట్రేషన్ ప్లాంట్లు, పైప్‌లైన్ల లీకేజీల అరికట్టడం ద్వారా 39 వార్డులలోని ప్రతి ఇంటికీ స్వచ్ఛమైన త్రాగునీటి సరఫరా.",
    pillar_4_title: "4. యువత & మహిళా సాధికారత",
    pillar_4_desc: "డిజిటల్ స్కిల్ కేంద్రాల ఏర్పాటు, డ్వాక్రా మహిళా సంఘాలకు ప్రోత్సాహం, స్వయం ఉపాధి రుణాలు మరియు పోటీ పరీక్షల శిక్షణ.",
    pillar_5_title: "5. పారదర్శక & అవినీతి రహిత పాలన",
    pillar_5_desc: "మున్సిపల్ అనుమతుల కోసం ఆన్‌లైన్ సింగిల్ విండో సదుపాయం, ప్రజా సమస్యలపై సత్వర పరిష్కారానికి కచ్చితమైన గడువుల అమలు.",
    pillar_6_title: "6. నాణ్యమైన రోడ్లు & మౌలిక వసతులు",
    pillar_6_desc: "గుంతలు లేని సిమెంట్ & తారు రోడ్లు, అన్ని వీధుల్లో ఎల్ఈడీ వీధి దీపాలు, మున్సిపల్ పాఠశాలల్లో ఆధునిక విద్యా సదుపాయాలు.",

    // Academia & Research Section
    acad_badge: "విద్యా & పరిశోధనా ప్రతిభ",
    acad_title: "అకాడమిక్ & ఏఐ పరిశోధనలు",
    acad_subtitle: "అసిస్టెంట్ ప్రొఫెసర్, ఐటీ / ఇంజనీరింగ్ — SRKR ఇంజనీరింగ్ కాలేజ్",
    acad_desc: "సాంకేతిక పరిజ్ఞానాన్ని ప్రజా సమస్యల పరిష్కారానికి జోడించడం. కంప్యూటర్ విజన్, ట్రాన్స్‌ఫార్మర్ నెట్‌వర్క్స్, డీసెంట్రలైజ్డ్ గవర్నెన్స్ పై ప్రచురితమైన అంతర్జాతీయ పరిశోధనలు.",
    paper_1_title: "Automated Detection of Eye Coloboma using Vision Transformers and Explainable AI Techniques",
    paper_1_venue: "IEEE ఇంటర్నేషనల్ కాన్ఫరెన్స్ (ICCCA)",
    paper_1_desc: "చిన్నారులలో కంటి లోపాలను ఖచ్చితత్వంతో గుర్తించేందుకు ఆర్టిఫిషియల్ ఇంటెలిజెన్స్ (విజన్ ట్రాన్స్‌ఫార్మర్స్) విధానం.",
    paper_2_title: "SenT-In: A Deep Sentiment-Aware Transformer Model for High-Precision Stock Trend Analysis",
    paper_2_venue: "IEEE కాన్ఫరెన్స్ (IC2PCT)",
    paper_2_desc: "ఆర్థిక విశ్లేషణ మరియు మార్కెట్ సెంటీమెంట్ ఆధారంగా ప్రిడిక్షన్ మోడల్ రూపకల్పన.",
    paper_3_title: "Decentralized Blockchain-Based Voting System with AI-ML Behavioral Analysis",
    paper_3_venue: "IEEE ప్రొసీడింగ్స్",
    paper_3_desc: "ఎన్నికల వ్యవస్థలో పారదర్శకత మరియు గోప్యత కోసం బ్లాక్‌చెయిన్ మరియు కృత్రిమ మేధస్సు కలయిక.",

    // Social Section
    social_badge: "అధికారిక సోషల్ మీడియా",
    social_title: "అధికారిక సోషల్ మీడియా వేదికలు",
    social_subtitle: "ధృవీకరించబడిన ఇన్‌స్టాగ్రామ్ మరియు ఫేస్‌బుక్ ద్వారా ప్రత్యక్ష సమాచారం",
    social_ig_handle: "@vegesnarohini.official",
    social_ig_title: "అధికారిక ఇన్‌స్టాగ్రామ్",
    social_ig_desc: "రోజువారీ పర్యటనలు, ప్రజా సమావేశాలు, విద్యార్థులతో సంభాషణల వీడియోలు మరియు ఫోటోలు.",
    social_fb_title: "అధికారిక ఫేస్‌బుక్ పేజీ",
    social_fb_handle: "వేగేశ్న రోహిణి (డిజిటల్ క్రియేటర్ / పబ్లిక్ ఫిగర్)",
    social_fb_desc: "వివరమైన పత్రికా ప్రకటనలు, వార్డుల పర్యటన సమాచారం, ప్రజా సమస్యలపై స్పందనలు.",

    // Media & Press Section
    media_badge: "వార్తలు & ప్రసంగాలు",
    media_title: "మీడియా ప్రసారాలు & ప్రెస్ మీట్‌లు",
    media_subtitle: "ముఖ్యమైన ఇంటర్వ్యూలు, పత్రికా సమావేశాలు మరియు ప్రసంగాలు చూడండి",

    // Praja Vani (Grievances) Section
    grievance_badge: "ప్రజా సమస్యల పరిష్కార వేదిక",
    grievance_title: "ప్రజావాణి — మీ సమస్య మా బాధ్యత",
    grievance_subtitle: "పారిశుద్ధ్యం, త్రాగునీరు, వీధి దీపాలు, డ్రైనేజీ సమస్యలను నేరుగా రోహిణి గారి కార్యాలయానికి నివేదించండి.",
    form_name_label: "మీ పూర్తి పేరు *",
    form_phone_label: "మొబైల్ / వాట్సాప్ నెంబర్ *",
    form_ward_label: "మీ మున్సిపల్ వార్డు *",
    form_locality_label: "కాలనీ / వీధి / ల్యాండ్‌మార్క్",
    form_category_label: "సమస్య రకం *",
    form_desc_label: "సమస్య వివరాలు స్పష్టంగా రాయండి *",
    form_priority_label: "ప్రాధాన్యత",
    form_submit_btn: "కార్యాలయానికి సమర్పించండి",
    track_title: "ఇప్పటికే సమస్య నమోదు చేశారా? స్థితిని పరిశీలించండి:",
    track_placeholder: "ట్రాకింగ్ ఐడీ నమోదు చేయండి (ఉదా: VR-BV-8402)",
    track_btn: "స్టేటస్ చూడండి"
  }
};

let currentLang = 'en';

function setLanguage(lang) {
  if (!translations[lang]) return;
  currentLang = lang;
  localStorage.setItem('vr_lang', lang);

  // Update body class
  if (lang === 'te') {
    document.body.classList.add('lang-te');
  } else {
    document.body.classList.remove('lang-te');
  }

  // Update text for all elements with data-i18n
  document.querySelectorAll('[data-i18n]').forEach(el => {
    const key = el.getAttribute('data-i18n');
    if (translations[lang][key]) {
      if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
        el.placeholder = translations[lang][key];
      } else {
        el.textContent = translations[lang][key];
      }
    }
  });

  // Update active Apple-style toggle buttons
  document.querySelectorAll('.lang-btn').forEach(btn => {
    if (btn.getAttribute('data-lang') === lang) {
      btn.classList.add('bg-white', 'text-[#1d1d1f]', 'shadow-sm');
      btn.classList.remove('text-[#86868b]', 'hover:text-[#1d1d1f]');
    } else {
      btn.classList.remove('bg-white', 'text-[#1d1d1f]', 'shadow-sm');
      btn.classList.add('text-[#86868b]', 'hover:text-[#1d1d1f]');
    }
  });
}

// Modal Video Player Handling
function openVideoModal(videoId, title) {
  const modal = document.getElementById('videoModal');
  const iframe = document.getElementById('modalVideoFrame');
  const modalTitle = document.getElementById('modalVideoTitle');

  if (modal && iframe) {
    iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
    if (modalTitle) modalTitle.textContent = title;
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }
}

function closeVideoModal() {
  const modal = document.getElementById('videoModal');
  const iframe = document.getElementById('modalVideoFrame');
  if (modal && iframe) {
    iframe.src = '';
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
  }
}

// Mobile Menu Toggle
function setupMobileMenu() {
  const btn = document.getElementById('mobileMenuBtn');
  const menu = document.getElementById('mobileNavMenu');
  if (btn && menu) {
    btn.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
    // Close on navigation click
    menu.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => {
        menu.classList.add('hidden');
      });
    });
  }
}

// Stat Counter Animation
function setupCounters() {
  const counters = document.querySelectorAll('.counter-val');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const target = parseInt(entry.target.getAttribute('data-count'), 10);
        if (target && !entry.target.dataset.animated) {
          entry.target.dataset.animated = "true";
          let count = 0;
          const duration = 1500;
          const step = Math.ceil(target / (duration / 25));
          const timer = setInterval(() => {
            count += step;
            if (count >= target) {
              entry.target.textContent = target.toLocaleString('en-IN') + (entry.target.getAttribute('data-plus') ? '+' : '');
              clearInterval(timer);
            } else {
              entry.target.textContent = count.toLocaleString('en-IN') + (entry.target.getAttribute('data-plus') ? '+' : '');
            }
          }, 25);
        }
      }
    });
  }, { threshold: 0.3 });

  counters.forEach(c => observer.observe(c));
}

// Initialize on DOM load
document.addEventListener('DOMContentLoaded', () => {
  const savedLang = localStorage.getItem('vr_lang') || 'en';
  setLanguage(savedLang);

  document.querySelectorAll('.lang-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      setLanguage(btn.getAttribute('data-lang'));
    });
  });

  setupMobileMenu();
  setupCounters();

  const modal = document.getElementById('videoModal');
  if (modal) {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        closeVideoModal();
      }
    });
  }
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeVideoModal();
  });
});
