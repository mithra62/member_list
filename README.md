# Member List
A replacement for the first party `memberlist` template tags and workflow that adds some much needed updates and funcctionality. 

## Features

1. Usable with native ExpressionEngine Template Tags (no legacy templates needed)
2. Allows for Role specific filtering
3. Uses GET based search params using colloquial field names (no more `m_field_id_12`)
4. Pagination based output using ExpressionEngine pagination tags

## Template Tags

The various tags available

### `results`

### `form`

#### Example

```html
<div id="member_left">
  <p class="">Find a Member</p>
  {exp:member_list:form return="{segment_1}"}
    <p>First Name: <br />
    <input name="first_name" type="text" value="{first_name}" /></p>
    <p>Last Name: <br />
    <input name="last_name" type="text" value="{last_name}" /></p>
    <p>City:<br />
    <input name="city" type="text" value="{city}" /></p>
    <p>State: <br />
      <input name="state" type="text" value="{state}" /></p>
    <p>Country: <br />
      <input name="country" type="text" value="{country}" /></p>
    <p align="center">
    <input type="submit" value="Search">
    </p>
    <p>&nbsp;</p>
  {/exp:member_list:form}
</div>
```

### `query_string`

Mostly used in conjunction with the pagination links

#### Example

```
{pagination_url}?{exp:member_list:query_string}
```