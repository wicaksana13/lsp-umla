<footer class="footer">


<div class="footer-brand">


<img src="{{ asset('assets/Logo LSP.png') }}">



<p>

Lembaga Sertifikasi Profesi<br>
Universitas Muhammadiyah<br>
Lamongan

</p>


</div>





<div>


<h3>
Alamat
</h3>



<p>

{!! nl2br(
    $settings['address'] ?? 'Alamat belum tersedia'
) !!}

</p>


</div>





<div>


<h3>
Hubungi Kami
</h3>



<p>
☎ 
{{ $settings['phone'] ?? '-' }}
</p>




<p>
✉ 
{{ $settings['email'] ?? '-' }}
</p>



</div>




</footer>



<div class="copyright">


Copyright © {{date('Y')}}.
Lembaga Sertifikasi Profesi Universitas Muhammadiyah Lamongan
All Right Reserved


</div>