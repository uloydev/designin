<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    {{-- <meta name="keywords" content="@foreach ($keywords as $keyword) {{ $keyword->value }} @endforeach"> --}}
    <meta name="keywords" content="desain grafis, jasa desain grafis, jasa design graphic, jasa logo, desain logo, design logo,
      desain, desain kemasan, desain instagram, jasa desain, jasa design, desain kaos, desainer kaos, jasa design grafis,
      jasa graphic design, jasa design graphic, logo futsal,poster kebersihan,jagalah kebersihan,jaga kebersihan, logo komunitas,
      logo hijabers,logo ayam,logo rumah,logo futsal keren,label makanan,logo sekolah,design spanduk,desain spanduk,
      contoh logo perusahaan,seragam kantoran,logo makanan,jasa desainer,design kaos reuni,jasa disain,kontes,
      brosur laundry,poster makanan,jasa design,jasa desain, poster hewan langka, kaos reunian,logo distro, desain kemasan,logo hijab,
      karanganbunga, desain jaket, pembuatan logo, gambar bus, sribu.com, desain kaos lengan panjang, logo rumah makan,
      contoh banner makanan, logo kaos, poster jagalah kebersihan, logo ayam geprek, desain kemasan makanan, jasa design grafis,
      desain kemeja, desainer jaket, lambang futsal, spanduk laundry, baju seragam kerja, logo otomotif, contoh logo organisasi,
      banner makanan, desain xbanner, logo thai tea, desain kaos olahraga, logo wedding organizer, logo makanan ringan,
      logo organisasi, logo reuni,
      logo kelompok tani, logo pecinta alam, logo produk, gambar jagalah kebersihan,
      banner reunian, gambar keripik pisang, logo olahraga, logo minuman, logo air, seragam kantor,
      brosur perumahan, logo perusahaan, design company profile, model kaos olah raga,
      lomba desain, logo persahabatan, logo rajawali, desain baju olahraga keren,
      logo bengkel ,logo keren buat kaos ,model baju perawat ,logo sound system
     ,lambang sepak bola yang belum dipakai ,kartu nama perusahaan ,logo akuntansi ,jasa pembuat logo
     ,banner warkop ,logo pemuda ,poster olahraga ,futsal team logo
     ,logo memancing      ,logo sepatu      ,logo futsal polos      ,logo indonesia,
          baju seragam,logo bintang,desainer cover buku,logo laundry
    ,rumah juara,logo salad buah,logo mancing mania,logo perpustakaan
    ,desain baju lengan panjang,lambang futsal keren,contoh label makanan keripik,logo majelis
    ,logo bengkel motor,logo pangkas rambut,logo kosmetik,logo sahabat
    ,label minuman,logo kecantikan,desain kaos reuni,contoh spanduk makanan
    ,desain kaos polo,aneka logam,gambaran es krim,sampul buku
    ,contoh logo olshop,contoh logo makanan,banner pernikahan,desain produk makanan
    ,spanduk ayam geprek,logo pondok pesantren,logo majelis ta lim,contoh banner laundry
    ,poster produk,logo ramadhan,logo kue kering,kemasan snack
    ,banner thai tea,logo arsitektur,logo teknik,logo produk makanan
    ,logo warung makan,desain baju kemeja,logo handphone,resto logo
    ,logo komputer,sertifikat pelatihan,poster air,desain baju futsal
    ,download aplikasi vco,logo pendidik,logo sekolah menengah atas,logo sekolah dasar
    ,desainer online,contoh banner,logo sekolah menengah pertama,desain kaos distro
    ,logo minangkabau,logo angka,stempel catering,contoh logo stiker kue kering
    ,logo rental mobil,spanduk nasi goreng,logo keripik singkong,logo toko kue
    ,contoh spanduk reuni,poster promosi,logo perusahaan makanan,logo fried chicken
    ,logo kedai kopi,,desain kemeja organisasi,label kue,logo rumah makan padang
    ,spanduk pernikahan,contoh kaos reuni smp,logo warung kopi,desainer packaging
    ,contoh logo makanan ringan,poster politik,spanduk makanan,logo distro keren
    ,desain kaos bola,contoh kartu nama perusahaan,logo kaos keren,banner reuni
    ,desain kemeja komunitas,logo squad mobile legend,tema moto gp,design contes
    ,logo teknik sipil,desain kaos olahraga terbaru,gambar bengkel motor,logo bank sampah
    ,jasa pembuatan kemasan produk,desain kaos lengan panjang depan belakang,jasa desain logo murah,logo toko bangunan
    ,banner ayam geprek,logo fotografer,desain hijab,contoh gambar label makanan
    ,logo ayam bakar,logo tour and travel,spanduk thai tea,contoh poster hewan langka,
    desain label baju,gambar fried chicken,logo makanan dan minuman,contoh spanduk promosi makanan
    ,lambang komunitas,desain seragam      ,logo olshop kosmetik      ,desain stiker makanan,desain kemeja polos,
    model kaos olah raga terbaru ,nama tim futsal yang belum dipakai,logo kuliner,logo go green,logo pesantren,desain kemeja keren,
    logo pomade,logo pencak silat,logo furniture,brosur catering,potofolio ,logo clothingan,bocor hk,jasa desain interior,
    juang profil id,logo jual pulsa,design toko bangunan,brosur laundry kiloan,contoh poster produk,logo ojek online,logo roti bakar,
    logo ikatan alumni,stempel toko bangunan,desain kaos reuni smp keren,model baju perawat korea,logo akreditasi,
    stiker kue kering unik,desain cutting sticker mobil,logo ayam goreng,seragam spg,contoh label kue kering
    ,gambar shark,lambang futsal polos,logo futsal polos keren,gambar poster hewan langka
    ,desain logo futsal terbaru,poster teknologi,gambar logo makanan,desain kerudung
    ,logo teknologi,logo notaris,logo keripik pisang,desain kaos olahraga lengan panjang">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <title>Desainin | No-fuss graphic design service solutions</title>
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
  </head>
  <body id="landingPage">
    <header>
      <nav>
        <a href="" class="nav__link nav__link--logo">Desainin</a>
        <a href="" class="nav__link"></a>
        <a href="" class="nav__link"></a>
        <a href="" class="nav__link"></a>
        <a href="" class="nav__link"></a>
      </nav>
    </header>
    {{-- carousel images --}}
    <h4>Carousel</h4>
    @foreach ($images as $image)
    <img src="{{$image->url}}" alt="{{$image->name}}">
    @endforeach
    {{-- end of carousel image --}}
    <hr>
    {{-- service list peek --}}
    <h4>Services</h4>
    @foreach ($services as $service)
    <div>title : {{ $service->title }}</div>
    @if (!is_null($service->image))
    <div>image : {{ $service->image }}</div>        
    @endif
    <div>description : {{ $service->description }}</div>
    <div>title : {{ $service->title }}</div>
    <div>agent : {{ $service->agent->name }}</div>
    @endforeach
    <a href="{{route('services')}}">view more</a>
    {{-- end of service list peek --}}
    <hr>
    {{-- news --}}
    <h4>News</h4>
    @foreach ($news as $item)
    <div>title : {{ $item->title }}</div>
    @if (!is_null($item->header_image))
    <div>header image : {{ $item->header_image }}</div>
    @endif
    <div>content : {{ $item->content }}</div>
    <div>author : {{ $item->author }}</div>
    @endforeach
    {{$news->links()}}
    {{-- end of news --}}
    <script src="{{ asset('js/jquery.js') }}" charset="utf-8"></script>
    <script src="{{ asset('js/customer.js') }}" charset="utf-8"></script>
  </body>
</html>
