<h1 style="font-size: 16px; font-weight: bold;">ご予約確認のお知らせ</h1>

<p>いつもReseをご利用いただきまして誠にありがとうございます。<br>
    ご予約いただいたお店のご来店日が本日となりましたので、ご連絡させていただきます。<br>
    ご来店をお待ちしております。
</p>

<h2 style="font-size: 16px;">ご予約内容</h2>

<ul>
    <li>ご予約者のお名前: {{ $reservation->user->name }}</li>
    <li>ご予約人数: {{ $reservation->member_count }}</li>
    <li>ご来店日時: {{ $reservation->reservation_date }} {{ $reservation->reservation_time }}</li>
    <li>ご予約店名: {{ $reservation->shop->shop_name }}</li>
</ul>

<p>※本メールは配信専用のため、ご返信いただきましてもお店へは届きません。</p>

<small>Rese, inc.</small>