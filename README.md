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

### `query_string`

Mostly used in conjunction with the pagination links

#### Example

```
{pagination_url}?{exp:member_list:query_string}
```