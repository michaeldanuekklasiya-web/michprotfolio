<footer class="site-footer" id="footer">
    <div class="container">
        <div class="footer-top">
            <div class="footer-brand">
                <a href="{{ url('/') }}" class="logo">MD<i>E</i><span class="dot"></span></a>
                <p>{{ config('portfolio.role') }} based in {{ config('portfolio.location') }}, crafting digital products, brands and experiences.</p>
            </div>
            <div>
                <h4>Explore</h4>
                <ul>
                    <li><a class="link-underline" href="{{ url('/') }}#about">About</a></li>
                    <li><a class="link-underline" href="{{ url('/') }}#work">Work</a></li>
                    <li><a class="link-underline" href="{{ url('/') }}#experience">Experience</a></li>
                    <li><a class="link-underline" href="{{ route('blog.index') }}">Journal</a></li>
                </ul>
            </div>
            <div>
                <h4>Social</h4>
                <ul>
                    @foreach (config('portfolio.socials') as $name => $url)
                        @if ($url !== '#')<li><a class="link-underline" href="{{ $url }}" target="_blank" rel="noopener">{{ $name }}</a></li>@endif
                    @endforeach
                </ul>
            </div>
            <div>
                <h4>Contact</h4>
                <ul>
                    <li><a class="link-underline" href="#contact" data-contact>Start a project</a></li>
                    @if (config('portfolio.email'))
                        <li><a class="link-underline" href="mailto:{{ config('portfolio.email') }}">{{ config('portfolio.email') }}</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="footer-word" aria-hidden="true">Michael D E</div>
        <div class="footer-bottom">
            <span>© {{ date('Y') }} {{ config('portfolio.name') }}. All rights reserved.</span>
            <span>Designed &amp; built in {{ config('portfolio.location') }}</span>
        </div>
    </div>
</footer>
