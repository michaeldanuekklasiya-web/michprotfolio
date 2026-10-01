<dialog class="dialog" id="contact" aria-labelledby="contact-title">
    <div class="dialog-inner">
        <div class="dialog-head">
            <div>
                <h3 id="contact-title">Let's <i>talk</i></h3>
                <p>Tell me about your project — I usually reply within a day.</p>
            </div>
            <button class="icon-btn" type="button" data-close aria-label="Close">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 6l12 12M18 6 6 18"/></svg>
            </button>
        </div>

        <form id="contact-form" action="{{ route('api.contact.store') }}" method="POST" novalidate>
            @csrf
            <input class="hp" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
            <div class="field">
                <label for="c-name">Name</label>
                <input id="c-name" name="name" type="text" required autocomplete="name" placeholder="Your name">
                <span class="error" data-error="name" hidden></span>
            </div>
            <div class="field">
                <label for="c-email">Email</label>
                <input id="c-email" name="email" type="email" required autocomplete="email" placeholder="you@company.com">
                <span class="error" data-error="email" hidden></span>
            </div>
            <div class="field">
                <label for="c-subject">Subject</label>
                <input id="c-subject" name="subject" type="text" required placeholder="Website, branding, product…">
                <span class="error" data-error="subject" hidden></span>
            </div>
            <div class="field">
                <label for="c-message">Message</label>
                <textarea id="c-message" name="message" rows="4" required placeholder="A few words about goals, timeline and budget"></textarea>
                <span class="error" data-error="message" hidden></span>
            </div>
            <button type="submit" class="btn btn-dark" style="width:100%;justify-content:center">
                <span class="label">Send message</span>
                <span class="spinner" hidden></span>
            </button>
            <p class="form-note" role="status" hidden></p>
        </form>
    </div>
</dialog>
