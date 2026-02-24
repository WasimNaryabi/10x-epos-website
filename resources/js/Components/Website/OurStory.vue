<template>
    <section class="story-section">
        <div class="container">
            <!-- Section Title -->
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Our Story</h2>
                <p class="section-subtitle">How real-world challenges led to a better solution</p>
            </div>

            <!-- Story Blocks -->
            <div class="story-blocks">
                <div 
                    v-for="(block, index) in storyBlocks" 
                    :key="index"
                    class="story-block"
                    data-aos="fade-up"
                    :data-aos-delay="index * 100"
                >
                    <p 
                        v-for="(paragraph, pIndex) in block.paragraphs" 
                        :key="pIndex"
                        v-html="paragraph"
                    ></p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const storyBlocks = ref([
    {
        paragraphs: [
            'We have spent years running and scaling businesses in the food and beverage industry, and one thing became clear very quickly: <strong class="text-primary">most EPOS and operational systems do not actually support operators.</strong>',
            'They slow you down, limit your options, and create unnecessary work, usually at the worst possible times.'
        ]
    },
    {
        paragraphs: [
            'Whether it was a busy takeaway or a full restaurant operation, we kept hitting the same walls: systems that could not adapt, support teams that did not understand the industry, and tools that made daily operations harder than they needed to be.',
            '<strong class="text-primary">As operators, we knew exactly what we needed and what was missing.</strong>'
        ]
    },
    {
        paragraphs: [
            'So instead of waiting for someone else to fix it, we decided to build the solution ourselves.',
            '<strong class="text-primary highlight-large">That is how 10x Global started.</strong>'
        ]
    }
]);
</script>

<style scoped>
.story-section {
    padding: 7rem 2rem;
    background: white;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 5rem;
}

.section-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: clamp(1rem, 2vw, 1.3rem);
    color: #64748b;
    font-weight: 500;
}

.story-blocks {
    display: grid;
    gap: 3rem;
}

.story-block {
    background: #f8fafc;
    padding: 3rem;
    border-radius: 25px;
    border-left: 5px solid #1a0b5e;
    transition: all 0.4s ease;
}

.story-block:hover {
    transform: translateX(10px);
    box-shadow: 0 10px 40px rgba(26, 11, 94, 0.15);
}

.story-block p {
    font-size: clamp(1.05rem, 1.5vw, 1.2rem);
    line-height: 2;
    color: #0f172a;
    margin-bottom: 1.5rem;
}

.story-block p:last-child {
    margin-bottom: 0;
}

.story-block :deep(.text-primary) {
    color: #1a0b5e;
    font-weight: 700;
}

.story-block :deep(.highlight-large) {
    font-size: 1.3rem;
}

@media (max-width: 768px) {
    .story-section {
        padding: 4rem 1.5rem;
    }

    .section-header {
        margin-bottom: 3rem;
    }

    .story-blocks {
        gap: 2rem;
    }

    .story-block {
        padding: 2rem;
    }
}
</style>