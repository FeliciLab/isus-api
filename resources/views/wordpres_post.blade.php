<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titulo }}</title>
    <style>
        body {
            max-width: 100%;
            font-family: 'Open Sans',Helvetica,Arial,Lucida,sans-serif;
            background: #fff;
            font-size: 18px;
            padding: 0px;
            margin: 0px;
        }
        main {
            font-size: 100%;
            padding: 0px 20px;
        }
        .big-button {
            font-weight: 400!important;
            font-size: 20px;
            cursor: pointer;
            color: #c7822f;
            text-shadow: 1px 1px 1px rgba(199, 199, 199, 0.9);
            text-decoration: none;
            word-wrap: break-word;
        }
        p {
            font-weight: 500;
            line-height: 1.7em;
            color: #666;
            background: transparent;
            font-size: 100%;
            padding-bottom: 1em;
            display: block;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
        }
        iframe {
            width: 100%;
            min-height: 500px;
        }
        section > img {
            width: 100%
        }
        header {
            margin: 24px 16px;
            font-weight: bolder;
            font-size: 24px;
            line-height: 28px;
            color: #00000099;
            font-style: normal;
        }
    </style>
</head>
<body>
    <header>
        {{ $titulo }}
    </header>
    <section>
        <img src="{{ $imagem }}" alt="postagem imagem" />
    </section>
    <main>
        {!! $postagem !!}
    </main>
</body>
</html>
