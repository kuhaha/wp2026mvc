<?php
class HtmlHelper
{
    public static function ol(array $options, array $attributes=[]): string
    {
        $tag = self::tag('li', $options, false, $attributes);
        return self::tag('ol', $tag);
    }

    public static function ul(array $options, array $attributes=[]): string
    {
        $tag = self::tag('li', $options, false, $attributes);
        return self::tag('ul', $tag);
    }

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

    public static function checkbox(array $options, string $name, array $checked=[], array $attributes=[]): string
    {
        $tag = '';
        foreach ($options as $value => $label){
            $_attributes = $attributes;
            $_attributes['type']='checkbox';
            $_attributes['name']=$name;
            $_attributes['value']=$value;
            if (in_array($value,$checked))
                $_attributes['checked']='checked';
            $tag .= self::tag('input', $label, true, $_attributes) . PHP_EOL;
        }
        return $tag;
    }


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


    public static function tag(string $tagname, array|string $content='', bool $void=false, array $attributes=[]): string
    {
        $attr = '';
        foreach ($attributes as $key => $value){
            $attr .= "{$key}='{$value}' ";
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
