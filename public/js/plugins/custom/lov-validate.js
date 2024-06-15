//Created by Cua 13 October 2020 Special for Armos

/*
 *  Class List:
 * number-input-only 
 * text-input-only
 * alnum-input-only
 * cant-pre-space
 * cant-space
 */

//I will make sure this code run on Script Load
$(function(){$(".number-input-only").keypress(function(i){(i.which<48||i.which>57)&&i.preventDefault()}),$(".text-input-only").keypress(function(i){(i.which<65||i.which>90)&&(i.which<97||i.which>122)&&32!=i.which&&i.preventDefault()}),$(".alnum-input-only").keypress(function(i){(i.which<48||i.which>57)&&(i.which<65||i.which>90)&&(i.which<97||i.which>122)&&32!=i.which&&i.preventDefault()}),$(".cant-pre-space").keypress(function(i){""==$(this).val()&&32==i.which&&i.preventDefault()}),$(".cant-pre-space").keyup(function(h){if(" "!=$(this).val())if(" "!=$(this).val().charAt(0));else{for(idx=0,x=$(this).val(),i=0;i<x.length;i++)if(" "!=x.charAt(i)){idx=i;break}$(this).val(x=$(this).val().substr(idx,$(this).val().length))}else $(this).val("")}),$(".cant-space").keypress(function(i){32==i.which&&i.preventDefault()}),$(".cant-space").keyup(function(i){$(this).val(x=$(this).val().replace(/\s+/g,""))})});