<?php
$faqs = [
    [
        'question' => 'What file types are supported?',
        'answer' => 'We support a wide range of file types, including documents (.pdf, .docx), images (.jpg, .png), videos (.mp4, .mov), and audio files (.mp3, .wav).'
    ],
    [
        'question' => 'What is the maximum file size?',
        'answer' => 'The maximum file size is 50MB'
    ],
    [
        'question' => 'How long are files stored?',
        'answer' => 'Files are stored for as long as your account is active, unless you delete them manually.'
    ],
    [
        'question' => 'Is my data private?',
        'answer' => 'Yes, your data is private and only accessible to you.'
    ],
    [
        'question' => 'How do I delete a file?',
        'answer' => 'You can delete a file from your dashboard by clicking the delete icon next to the file you wish to remove.'
    ],
];
?>
<section class="faq-section">
    <h1 class="faq-title">Frequently Asked Questions</h1>
    <div class="faq-list">
        <?php foreach ($faqs as $faq): ?>
            <div class="faq-item">
                <button class="faq-question" type="button"><?php echo htmlspecialchars($faq['question']); ?></button>
                <div class="faq-answer">
                    <?php echo htmlspecialchars($faq['answer']); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(btn => {
        btn.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            const expanded = this.classList.toggle('active');
            if (expanded) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
            } else {
                answer.style.maxHeight = null;
            }
            // Close others
            faqQuestions.forEach(otherBtn => {
                if (otherBtn !== this) {
                    otherBtn.classList.remove('active');.
                    
                    otherBtn.nextElementSibling.style.maxHeight = null;
                }
            });
        });
    });
});
</script>