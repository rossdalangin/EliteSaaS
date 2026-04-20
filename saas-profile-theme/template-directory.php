<?php
/**
 * Template Name: Discovery Directory
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main id="directory-page" class="site-main">
    <section class="landing-content" style="padding-top: 100px;">
        <div style="text-align:center; margin-bottom:64px;">
            <h1 class="landing-title">Discover Elite Creators</h1>
            <p class="landing-hero-text">Explore the best digital identities built with our platform.</p>

            <div class="directory-search" style="margin-top:48px; max-width:560px; margin-left:auto; margin-right:auto;">
                <form action="" method="GET" class="hero-claim-form" style="padding: 6px;">
                    <input type="text" name="s" placeholder="Search creators by name..." value="<?php echo esc_attr($_GET['s'] ?? ''); ?>" style="flex:1; border:none; padding:12px 24px; outline:none; font-weight:600; background:transparent; font-family: inherit; font-size: 1.1rem;">
                    <?php if($active_niche = $_GET['niche'] ?? '') : ?><input type="hidden" name="niche" value="<?php echo esc_attr($active_niche); ?>"><?php endif; ?>
                    <button type="submit" class="hero-claim-btn" style="padding: 12px 32px;">Search</button>
                </form>
            </div>

            <div class="directory-filters" style="margin-top:32px; display:flex; justify-content:center; gap:12px; flex-wrap:wrap;">
                <?php
                $active_niche = $_GET['niche'] ?? '';
                $niches = [
                    '' => 'All Experts',
                    'coach' => 'Coaches',
                    'consultant' => 'Consultants',
                    'realtor' => 'Real Estate',
                    'artist' => 'Artists',
                    'agency' => 'Agencies',
                    'creator' => 'Creators'
                ];
                foreach($niches as $slug => $label) :
                    $is_active = ($active_niche === $slug);
                    $url = $slug ? add_query_arg('niche', $slug) : remove_query_arg('niche');
                ?>
                    <a href="<?php echo esc_url($url); ?>" style="padding:10px 20px; border-radius:var(--radius-full); text-decoration:none; font-weight:700; font-size:0.9rem; transition:var(--transition-base); <?php echo $is_active ? 'background:var(--primary-color); color:#fff;' : 'background:#fff; border:1px solid var(--border-color); color:var(--text-light);'; ?>">
                        <?php echo esc_html($label); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="directory-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:32px;">
            <?php
            $args = [
                'post_type' => 'saas_profile',
                'post_status' => 'publish',
                'meta_query' => [
                    'relation' => 'AND',
                    ['key' => '_saas_show_in_directory', 'value' => '1']
                ],
                'numberposts' => 50
            ];

            if ($active_niche) {
                $args['meta_query'][] = ['key' => '_saas_niche', 'value' => $active_niche];
            }

            if ($search = $_GET['s'] ?? '') {
                $args['s'] = $search;
            }

            $profiles = get_posts($args);

            if($profiles) :
                foreach($profiles as $p) :
                    $p_meta = saas_get_profile_meta($p->ID);
                    $p_niche = get_post_meta($p->ID, '_saas_niche', true);
                    ?>
                    <a href="<?php echo home_url('/' . $p->post_name); ?>" class="profile-card feature-card-light" style="text-decoration:none; padding:40px; text-align:center; position:relative; display: block; transition: var(--transition-bounce);">
                        <?php if($p_niche): ?>
                            <span class="badge-ui" style="position:absolute; top:20px; right:20px; font-size:0.65rem;"><?php echo $p_niche; ?></span>
                        <?php endif; ?>
                        <div style="margin-bottom:24px;">
                            <?php if (has_post_thumbnail($p->ID)) : ?>
                                <?php echo get_the_post_thumbnail($p->ID, 'thumbnail', ['style' => 'width:100px; height:100px; border-radius:50%; object-fit:cover; border:4px solid var(--primary-color); box-shadow: var(--shadow-md);']); ?>
                            <?php else : ?>
                                <div style="width:100px; height:100px; border-radius:50%; background: var(--bg-color); display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 2rem; border: 4px solid var(--primary-color);">👤</div>
                            <?php endif; ?>
                        </div>
                        <h3 style="margin:0; font-size:1.4rem; font-weight:800; color: var(--text-color);"><?php echo esc_html($p->post_title); ?></h3>
                        <p style="font-size:0.95rem; color:var(--text-light); margin:12px 0;"><?php echo esc_html($p_meta['headline']); ?></p>
                        <div style="margin-top:24px; font-weight:800; color:var(--primary-color); text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em;">View Profile →</div>
                    </a>
                    <style>
                    .profile-card:hover { transform: translateY(-12px); box-shadow: var(--shadow-xl); border-color: var(--primary-light); }
                    </style>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="grid-column: 1 / -1; padding: 64px; background: var(--bg-color); border-radius: var(--radius-xl); text-align: center; color: var(--text-lighter);">
                    <p style="margin: 0; font-weight: 700; font-size: 1.25rem;">No public profiles found matching your search.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
