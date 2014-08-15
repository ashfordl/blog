<?php

class BlogpostsSeeder extends Seeder
{
    public function run()
    {
        $post = new Blogpost();
        $post->title = "1st Blogpost";
        $post->content = "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>";
        // $post->tags = "first,post,lorem,ipsum,latin";
        $post->deleted = false;
        $post->save();

        $post = new Blogpost();
        $post->title = "2nd Blogpost";
        $post->content = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod ut tortor at rutrum. In facilisis neque sed imperdiet sollicitudin. Sed viverra nibh nisl, quis vulputate quam suscipit nec. Sed in ante scelerisque, faucibus orci eget, blandit diam. Donec fringilla, justo vehicula congue euismod, justo orci feugiat libero, non eleifend odio urna cursus dolor. Proin lacus eros, tempus sit amet convallis sit amet, viverra vel ipsum. Morbi vel porta nibh. Vivamus felis neque, eleifend quis lorem ac, viverra pretium quam. Nulla euismod, dui vitae rhoncus lobortis, ligula nulla hendrerit felis, nec consequat nunc mi ac est. Nam facilisis dui sed sapien dictum, vel pretium elit porta. Proin quis facilisis ante. Aliquam tellus diam, pharetra quis nibh sed, venenatis luctus diam. Vivamus gravida purus et ligula tristique ullamcorper.</p><p>Donec viverra, mi sit amet mattis gravida, mauris orci mollis massa, ut mattis lorem nisi non nulla. Phasellus erat nulla, interdum vel sem ac, dictum mollis dui. Cras mollis, orci at congue porttitor, nunc nunc pulvinar libero, a congue risus purus vitae arcu. Donec commodo elementum dignissim. Nunc eget rutrum nibh. Maecenas blandit tortor elit. Fusce ut est purus.</p>";
        // $post->tags = "first,post,lorem,ipsum,latin";
        $post->deleted = false;
        $post->save();
    }
}