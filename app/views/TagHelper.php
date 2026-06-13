<?php
class TagHelper
{
    // 順序付きリストを生成する。
    // 例：TagHelper::ol(['数学','理科','英語']);
    public static function ol(array $options, array $attributes=[]): string
    {
        $tag = self::tag('li', $options, false, $attributes);
        return self::tag('ol', $tag);
    }

    // 順序無しリストを生成する。
    // 例：TagHelper::ul(['数学','理科','英語']);
    public static function ul(array $options, array $attributes=[]): string
    {
        $tag = self::tag('li', $options, false, $attributes);
        return self::tag('ul', $tag);
    }

    // ラジオボタンを複数生成する。
    // TagHelper::radio([1=>'数学',2=>'理科',3=>'英語'], 'subject', 2);
    public static function radio(array $options, string $name, mixed $checked=null, array $attributes=[])
    {
        $tag = '';
        foreach ($options as $value => $label){
            $_attributes = $attributes;
            $_attributes['type']='radio';
            $_attributes['name']=$name;
            $_attributes['value']=$value;
            if ($checked==$value) $_attributes['checked']='checked';
            $tag .= self::tag('input', $label, true, $_attributes). PHP_EOL;
        }
        return $tag;
    }

    // チェックボックスを複数生成する。
    // TagHelper::checkbox([1=>'数学',2=>'理科',3=>'英語'], 'subject', [1,3]);
    public static function checkbox(array $options, string $name, array $checked=[], array $attributes=[]): string
    {
        $tag = '';
        foreach ($options as $value => $label){
            $_attributes = $attributes;
            $_attributes['type']='checkbox';
            $_attributes['name']=$name;
            $_attributes['value']=$value;
            if (in_array($value, $checked))
                $_attributes['checked']='checked';
            $tag .= self::tag('input', $label, true, $_attributes) . PHP_EOL;
        }
        return $tag;
    }

    // プルダウンリストを生成する。
    // TagHelper::select([1=>'数学',2=>'理科',3=>'英語'], 'subject', 2);
    public static function select(array $options, array $name, mixed $selected=null, array $attributes=[]): string
    {
        $tag = '';
        foreach ($options as $value => $label){
            $_attributes = ['value'=>$value];
            if ($value == $selected)
                $_attributes['selected']='selected';
            $tag .= self::tag('option', $label, true, $_attributes) . PHP_EOL;
        }
        $attributes['name'] = $name;
        return self::tag('select', $tag, true, $attributes);
    }

    // 一般的なタグを生成する。
    // 例1(単一タグ)：TagHelper::tag('h1','題目');
    // 例2(複数タグ)：TagHelper::tag('li',['数学','理科','英語']);
    public static function tag(string $tagname, array|string $content='', bool $void=false, array $attributes=[]): string
    {
        $attr = '';
        foreach ($attributes as $key => $value){
            $attr .= "{$key}=\"{$value}\" ";
        }
        $attr = trim($attr);
        $open_tag = $void ? "<{$tagname} {$attr}/>" : "<{$tagname} {$attr}>";
        $close_tag = "</$tagname>";
        $tag = '';
        if (is_array($content)){
            foreach ($content as $text){
                $tag .= $void ? "{$open_tag}{$text}" : "{$open_tag}{$text}{$close_tag}" . PHP_EOL;
            }
            return $tag;
        }
        return $void ? "{$open_tag}{$content}" : "{$open_tag}{$content}{$close_tag}"; 
    }
}
