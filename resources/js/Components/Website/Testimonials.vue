<template>
    <section id="testimonials" class="testimonials-section">
        <div class="testimonials-container">
            <!-- Section Header -->
            <div class="section-header" data-aos="fade-up">
                <span class="section-badge">Testimonials</span>
                <h2 class="section-title">Trusted by Restaurants Worldwide</h2>
                <p class="section-subtitle">
                    See what our customers have to say about transforming their business with 10x Global EPOS
                </p>
            </div>

            <!-- Stats -->
            <div class="stats-grid" data-aos="fade-up">
                <div class="stat-card">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Active Restaurants</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">50K+</div>
                    <div class="stat-label">Daily Transactions</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">99%</div>
                    <div class="stat-label">Customer Satisfaction</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">Uptime</div>
                </div>
            </div>

            <!-- Testimonials Grid -->
            <div class="testimonials-grid">
                <div 
                    v-for="(testimonial, index) in testimonials" 
                    :key="index"
                    class="testimonial-card"
                    data-aos="fade-up"
                    :data-aos-delay="index * 100"
                >
                    <div class="stars">
                        <Icon v-for="n in 5" :key="n" name="star" :size="18" color="#fbbf24" />
                    </div>
                    <p class="testimonial-text">"{{ testimonial.text }}"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar" :style="{ background: testimonial.color }">
                            {{ testimonial.initials }}
                        </div>
                        <div class="author-info">
                            <div class="author-name">{{ testimonial.name }}</div>
                            <div class="author-role">{{ testimonial.role }}</div>
                            <div class="author-company">{{ testimonial.company }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Testimonial -->
            <div class="video-testimonial" data-aos="fade-up">
                <h3>Watch How We Helped Transform Their Business</h3>
                <div class="video-wrapper">
                    <div class="video-placeholder">
                        <Icon name="rocket" :size="80" color="white" />
                        <p>Customer Success Story</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import Icon from '@/Components/Shared/Icon.vue';

const testimonials = ref([
    {
        name: 'Sarah Johnson',
        role: 'Owner',
        company: 'The Corner Bistro, London',
        text: 'Since implementing 10x Global EPOS, our table turnover has increased by 30% and order accuracy is near perfect. The KOT system has revolutionized our kitchen operations.',
        initials: 'SJ',
        color: 'linear-gradient(135deg, #667eea, #764ba2)'
    },
    {
        name: 'Michael Chen',
        role: 'General Manager',
        company: 'Spice Garden Restaurant Chain',
        text: 'Managing multiple locations was a nightmare until we switched to 10x EPOS. Now I can see real-time data from all our restaurants in one dashboard. Game changer!',
        initials: 'MC',
        color: 'linear-gradient(135deg, #f093fb, #f5576c)'
    },
    {
        name: 'Emma Williams',
        role: 'Cafe Owner',
        company: 'Sunrise Cafe, Manchester',
        text: 'The inventory management feature alone has saved us thousands in waste. The system is intuitive and my staff picked it up in less than a day. Highly recommended!',
        initials: 'EW',
        color: 'linear-gradient(135deg, #4facfe, #00f2fe)'
    },
    {
        name: 'David Brown',
        role: 'Restaurant Manager',
        company: 'The Grill House, Birmingham',
        text: 'Customer support is outstanding. Any issues are resolved within hours. The reporting features help us make data-driven decisions every single day.',
        initials: 'DB',
        color: 'linear-gradient(135deg, #43e97b, #38f9d7)'
    },
    {
        name: 'Lisa Anderson',
        role: 'Co-Owner',
        company: 'Pasta Palace, Edinburgh',
        text: 'We saw immediate improvements in efficiency. The staff scheduling feature has cut our labor costs by 15% while maintaining better service quality.',
        initials: 'LA',
        color: 'linear-gradient(135deg, #fa709a, #fee140)'
    },
    {
        name: 'James Wilson',
        role: 'Owner',
        company: 'Urban Eats, Cardiff',
        text: 'Best investment we made for our business. The table management and reservation system has reduced wait times and improved customer satisfaction dramatically.',
        initials: 'JW',
        color: 'linear-gradient(135deg, #30cfd0, #330867)'
    }
]);
</script>

<style scoped>
.testimonials-section {
    padding: 6rem 2rem;
    background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
}

.testimonials-container {
    max-width: 1400px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-badge {
    display: inline-block;
    padding: 0.5rem 1.5rem;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: 1.125rem;
    color: #64748b;
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.8;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.stat-card {
    text-align: center;
    padding: 2rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.stat-number {
    font-size: 3rem;
    font-weight: 800;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: #64748b;
    font-weight: 500;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.testimonial-card {
    background: white;
    padding: 2.5rem;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s, box-shadow 0.3s;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
}

.stars {
    margin-bottom: 1.5rem;
    display: flex;
    gap: 0.25rem;
}

.testimonial-text {
    font-size: 1.0625rem;
    line-height: 1.8;
    color: #334155;
    margin-bottom: 2rem;
    font-style: italic;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.author-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.author-name {
    font-weight: 700;
    color: #0f172a;
    font-size: 1.0625rem;
}

.author-role {
    color: #667eea;
    font-size: 0.9375rem;
    font-weight: 500;
}

.author-company {
    color: #64748b;
    font-size: 0.875rem;
}

.video-testimonial {
    text-align: center;
    margin-top: 4rem;
}

.video-testimonial h3 {
    font-size: 2rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 2rem;
}

.video-wrapper {
    max-width: 900px;
    margin: 0 auto;
}

.video-placeholder {
    position: relative;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    border-radius: 20px;
    padding: 4rem 2rem;
    color: white;
    cursor: pointer;
    transition: transform 0.3s;
}

.video-placeholder:hover {
    transform: scale(1.02);
}

.video-placeholder p {
    font-size: 1.25rem;
    font-weight: 600;
}

@media (max-width: 768px) {
    .testimonials-section {
        padding: 4rem 1rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .testimonials-grid {
        grid-template-columns: 1fr;
    }

    .stat-number {
        font-size: 2.5rem;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>